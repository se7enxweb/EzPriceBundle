<?php

namespace Efl\WebBundle\Controller;

use Efl\WebBundle\Exceptions\Newsletter\HashAlreadyUsedException;
use Efl\WebBundle\Exceptions\Newsletter\HashNotFoundException;
use Efl\WebBundle\Exceptions\Newsletter\NewsletterAccessDenied;
use Efl\WebBundle\Form\Type\Newsletter\SubscriptionBoxType;
use Efl\WebBundle\Form\Type\Newsletter\SubscriptionType;
use eZ\Bundle\EzPublishCoreBundle\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

class NewsletterController extends Controller
{
    /**
     * @return Response
     */
    public function suscriptionBoxAction()
    {
        $response = new Response();

        $form = $this->createForm( new SubscriptionBoxType( $this->get( 'router' ) ) );

        return $this->render(
            'EflWebBundle:footer:newsletter_subscription.html.twig',
            array(
                'form' => $form->createView()
            ),
            $response
        );
    }

    public function subscribeAction( Request $request )
    {
        $response = new Response();

        $form = $this->createForm( new SubscriptionBoxType( $this->get( 'router') ) );
        $email = '';

        $form->handleRequest( $request );
        if ( $request->isMethod( 'post' ) && $form->get( 'save' )->isClicked()  )
        {
            $email = $form->get( 'email' )->getData();
        }

        $subscriptionForm = $this->createForm( new SubscriptionType(
            $email,
            $this->get( 'eflweb.newsletter_helper' ),
            $this->get( 'ezpublish.api.service.location' ),
            $this->get( 'router'),
            $this->get( 'translator' ),
            $this->container->getParameter( 'eflweb.politica_privacidad.location_id' )
        ));

        if ( $request->isMethod( 'post' ) && !$form->get( 'save' )->isClicked() )
        {
            $subscriptionForm->bind( $request );
            if ( $subscriptionForm->isValid() )
            {
                if ( $subscription = $this->get( 'eflweb.newsletter_helper' )->createSubscription(
                    $subscriptionForm->getData()
                ) )
                {
                    $this->get( 'eflweb.newsletter_helper' )->sendSubcriptionConfirmationMail( $subscription );
                }

                $this->get( 'session' )->getFlashBag()->add(
                     'notice',
                     $this->get( 'translator' )->trans( 'Thank you for your message, we will get back to you as soon as possible.' )
                );

                return $this->redirect(
                     $this->generateUrl( 'newsletter_subscribe')
                );
            }
        }

        return $this->render(
            'EflWebBundle:newsletter:subscription_form.html.twig',
            array(
                'form' => $subscriptionForm->createView()
            ),
            $response
        );
    }

    /**
     * Controlador para manejar la confirmación del usuario
     */
    public function configureAction( Request $request )
    {
        $response = new Response();
        $hash = $request->get( 'hash' );
        $vars = array();

        try
        {
            $confirmation = $this->get( 'eflweb.newsletter_helper' )->confirmSubscription( $hash );

            if ( !is_null( $confirmation['ebook'] ) )
            {
                $downLoadLink = $this->get( 'eflweb.newsletter_helper' )->generateDownloadLinkForEbook( $confirmation['ebook'] );
                $vars['downloadLink'] = $downLoadLink;
            }
        }
        catch ( HashNotFoundException $e )
        {
            $this->get( 'session' )->getFlashBag()->add(
                 'error',
                 $this->get( 'translator' )->trans( 'Hash inválido.' )
            );
        }
        catch ( HashAlreadyUsedException $e )
        {
            $this->get( 'session' )->getFlashBag()->add(
                 'error',
                     $this->get( 'translator' )->trans( 'Este hash ya sido usado.' )
            );
        }
        catch ( NewsletterAccessDenied $e )
        {
            $this->get( 'session' )->getFlashBag()->add(
                 'error',
                     $this->get( 'translator' )->trans( 'Hay un problema para completar su suscripción, por favor póngase en contacto con nosotros.' )
            );
        }

        return $this->render(
            'EflWebBundle:newsletter:subscription_confirmation.html.twig',
            $vars,
            $response
        );
    }
}