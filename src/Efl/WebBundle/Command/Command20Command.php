<?php
/**
 * Created by PhpStorm.
 * User: carlos
 * Date: 08/09/14
 * Time: 08:31
 */

namespace Efl\WebBundle\Command;

use eZ\Publish\Core\Repository\Values\ContentType\ContentTypeCreateStruct as CreateTypeStruct;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use eZ\Publish\API\Repository\Values\Content\Query\Criterion;
use eZ\Publish\API\Repository\Values\ContentType\FieldDefinitionCreateStruct;


/**
 * Class Command20Command
 * @package Efl\WebBundle\Command
 *
 * Añade un id a la table efl_orders para hacer primaryy key
 *
 */
class Command20Command extends ContainerAwareCommand
{
    protected function configure()
    {
        $this->setName( 'efl:web:command20' )->setDefinition(array());
    }

    protected function execute( InputInterface $input, OutputInterface $output )
    {
        /** @var \eZ\Publish\Core\Persistence\Database\DatabaseHandler; */
        $dbHandler = $this->getContainer()->get( 'ezpublish.api.storage_engine.legacy.dbhandler' );
        $dbHandler->exec(
            'ALTER TABLE  `efl_orders` ADD  `id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY FIRST;
             ALTER TABLE  `efl_orders` ADD INDEX (  `productcollection_id` )'
        );
    }
}