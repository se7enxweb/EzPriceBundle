<?php

namespace Efl\WebBundle\Controller;

use eZ\Bundle\EzPublishCoreBundle\Controller;
use Symfony\Component\HttpFoundation\Response;

class ProductController extends Controller
{
    /**
     * Muestra imagen del producto y enlaces a vídeo, previsualización y sumario cuando los hay
     *
     * @param $locationId
     * @return Response
     */
    public function leftPartAction( $locationId, $viewType = 'full' )
    {
        $response = new Response;
        $response->setPublic();
        $response->setSharedMaxAge( 86400 * 30 );
        $response->headers->set('X-Location-Id', $locationId);

        $location = $this->getRepository()->getLocationService()->loadLocation($locationId);
        $content = $this->getRepository()->getContentService()->loadContent($location->contentId);

        return $this->render(
            'EflWebBundle:product:leftpart.html.twig',
            array(
                'viewType' => $viewType,
                'location' => $location,
                'content' => $content,
                'image' => $this->get('eflweb.product_helper')->getImageByProductLocationId($locationId),
            ),
            $response
        );
    }

    /**
     * Full view para producto
     *
     * @param $locationId
     * @param $viewType
     * @param bool $layout
     * @param array $params
     * @return mixed
     */
    public function fullAction( $locationId, $viewType, $layout = false, array $params = array() )
    {
        $location = $this->getRepository()->getLocationService()->loadLocation( $locationId );

        return $this->get( 'ez_content' )->viewLocation(
            $locationId,
            $viewType,
            $layout,
            array(
                'viewType' => $viewType,
                'image' => $this->get( 'eflweb.product_helper' )->getImageByProductLocationId( $locationId ),
                'parentContent' => $this->getRepository()->getContentService()->loadContent(
                    $this->getRepository()->getLocationService()->loadLocation( $location->parentLocationId )->contentId
                ),
                'fecha_aparicion' => $this->get( 'eflweb.product_helper' )->getFechaAparicionByProductLocationId( $locationId ),
                'nValoraciones' => $this->get( 'eflweb.reviews_service' )->getReviewsCountForLocation( $location ),
                'tabsInfo' => $this->get( 'eflweb.product_helper' )->getActiveTab( $locationId )
            )
        );
    }

    /**
     * Previsualización producto
     *
     * @param $locationId
     * @return mixed
     */
    public function previewAction( $locationId )
    {
        $location = $this->getRepository()->getLocationService()->loadLocation( $locationId );
        $response = new Response;
        $response->setPublic();
        $response->setSharedMaxAge(86400 * 30);
        $response->headers->set('X-Location-Id', $locationId);

        return $this->get( 'ez_content' )->viewLocation(
            $locationId,
            'preview',
            false,
            array(
                'viewType' => 'preview',
                'image' => $this->get( 'eflweb.product_helper' )->getImageByProductLocationId( $locationId ),
                'parentContent' => $this->getRepository()->getContentService()->loadContent(
                    $this->getRepository()->getLocationService()->loadLocation( $location->parentLocationId )->contentId
                ),
                'nValoraciones' => $this->get( 'eflweb.valorations' )->getReviewsNumberForLocationId( $locationId )
            ),
            $response
        );
    }

    /**
     * Sumario producto
     *
     * @param $locationId
     * @return mixed
     */
    public function summaryAction( $locationId )
    {
        $location = $this->getRepository()->getLocationService()->loadLocation( $locationId );
        $response = new Response;
        $response->setPublic();
        $response->setSharedMaxAge(86400 * 30);
        $response->headers->set('X-Location-Id', $locationId);

        return $this->get( 'ez_content' )->viewLocation(
            $locationId,
            'summary',
            false,
            array(
                'viewType' => 'summary',
                'image' => $this->get( 'eflweb.product_helper' )->getImageByProductLocationId( $locationId ),
                'parentContent' => $this->getRepository()->getContentService()->loadContent(
                    $this->getRepository()->getLocationService()->loadLocation( $location->parentLocationId )->contentId
                ),
                'nValoraciones' => $this->get( 'eflweb.valorations' )->getReviewsNumberForLocationId( $locationId )
            ),
            $response
        );
    }

    /**
     * Vídeo producto
     *
     * @param $locationId
     * @return mixed
     */
    public function videoAction( $locationId )
    {
        $location = $this->getRepository()->getLocationService()->loadLocation( $locationId );
        $response = new Response;
        $response->setPublic();
        $response->setSharedMaxAge(86400 * 30);
        $response->headers->set('X-Location-Id', $locationId);

        return $this->get( 'ez_content' )->viewLocation(
            $locationId,
            'video',
            false,
            array(
                'parentContent' => $this->getRepository()->getContentService()->loadContent(
                    $this->getRepository()->getLocationService()->loadLocation( $location->parentLocationId )->contentId
                ),
            ),
            $response
        );
    }

    /**
     * Productos comprados en otras compras donde se compró este producto
     *
     * @param $contentId
     * @return Response
     */
    public function getRelatedProductsByOrdersAction( $contentId )
    {
        $contentIds = array( $contentId );
        $products = $this->get( 'eflweb.basket' )->relatedPurchasedListForContentIds( $contentIds, 4 );

        return $this->render(
            'EflWebBundle:product:relatedbyorders.html.twig',
            array()
        );
    }
}