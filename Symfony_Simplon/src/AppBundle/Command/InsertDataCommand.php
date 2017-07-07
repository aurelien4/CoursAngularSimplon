<?php
/**
 * Created by PhpStorm.
 * User: dev
 * Date: 30/05/17
 * Time: 15:28
 */

namespace AppBundle\Command;


use AppBundle\Entity\CommuneFrance;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Config\Definition\Exception\Exception;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\Encoder\CsvEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;


class InsertDataCommand extends ContainerAwareCommand
{
    protected function configure(){

        $this
            ->setName('app:test')
            ->setDescription('addData_Commune')
            ->setHelp('this command allows you to add the data of the csv.gouv');

    }

    protected function execute(InputInterface $input , OutputInterface $output){
        // outputs multiple lines to the console (adding "\n" at the end of each line)
        $output->writeln([
            'User Creator',
            '============',
            'jean michou',
        ]);

        // outputs a message followed by a "\n"
        $output->writeln('Execution du script!');
        $serializer = new Serializer([new ObjectNormalizer()], [new CsvEncoder()]);
        ini_set('memory_limit', '8192M');
        ini_set('max_execution_time', '3600S');
        $datas = $serializer->decode(file_get_contents('web/eucircos_regions_departements_circonscriptions_communes_gps.csv'), 'csv');
        $arrayCommune = [];
        $em = $this->getContainer()->get('doctrine')->getManager();
        $num= 0;
        foreach ($datas as $data => $key) {

            array_push($arrayCommune, $key);
        }
        $arrayCommuneRefactor = [];

        foreach ($arrayCommune as $key => $value) {

            foreach ($value as $key => $value) {
                $newkey = explode(";", $key);
                $newvalue = explode(";", $value);
                if (sizeof($newkey) === sizeof($newvalue)) {
                   try{
                       $newArrayCommune = array_combine($newkey, $newvalue);
                       $com = new CommuneFrance();
                       $com->setNomRegion($newArrayCommune['nom_région']);
                       $com->setNomCommune($newArrayCommune['nom_commune']);
                       $em->persist($com);
                       $num++;
                       if($num%200 == 1) {
                           $em->flush();
                           $output->write( $num .'/'. sizeof($arrayCommune) .'======== lignes ajoutées à la base', '</br>');
                       }

                   }catch(\Doctrine\ORM\ORMException $e){
                       $output->write('et cest le fail' . $e);
                   }
                }
            }
        }



    // outputs a message without adding a "\n" at the end of the line
        $output->write('Les données ont bien été ecrite en base');
    }
}