<?php
/**
 * This file is part of VinceTAdminConfigurationBundle for Symfony2
 *
 * @category VinceT
 * @package  VinceTAdminConfigurationBundle
 * @author   Vincent Touzet <vincent.touzet@gmail.com>
 * @license  MIT License view the LICENSE file that was distributed with this source code.
 * @link     https://github.com/vincenttouzet/AdminBundle
 */

namespace VinceT\AdminConfigurationBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\HttpFoundation\Request;
use VinceT\AdminConfigurationBundle\Entity\ConfigType;


/**
 * This file is part of VinceTAdminConfigurationBundle for Symfony2
 *
 * @category VinceT
 * @package  VinceTAdminConfigurationBundle
 * @author   Vincent Touzet <vincent.touzet@gmail.com>
 * @license  MIT License view the LICENSE file that was distributed with this source code.
 * @link     https://github.com/vincenttouzet/AdminBundle
 */
class CreateDefaultTypesCommand extends ContainerAwareCommand
{
    /**
     * configure command
     *
     * @return null
     */
    protected function configure()
    {
        parent::configure();
        $this
            ->setName('vincet:admin-configuration:install-types')
            ->setDescription('Install some types')
            ->setHelp(
<<<EOF
The <info>vincet:admin-configuration:install-types</info> command install some types.
EOF
            );
    }

    /**
     * execute command
     *
     * @param InputInterface  $input  InputInterface instance
     * @param OutputInterface $output OutputInterface instance
     *
     * @return null
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $typeManager = $this->getContainer()->get('admin.configuration.configtype_manager');
        $repo = $typeManager->getRepository();
        $types = array(
            'text' => 'Text Field',
            'textarea' => 'Text Area',
            'email' => 'Email',
            'checkbox' => 'Boolean',
            'integer' => 'Integer',
            'number' => 'Number',
            'money' => 'Price',
            'percent' => 'Percent',
            'url' => 'Url',
            'datetime' => 'DateTime',
            'date' => 'Date',
            'time' => 'Time',
            'bootstrap_datepicker' => 'DatePicker',
            'bootstrap_timepicker' => 'TimePicker',
            'bootstrap_datetimepicker' => 'DateTimePicker',
        );

        foreach ($types as $formType => $label) {
            $type = $repo->findOneByFormType($formType);
            if ( !$type ) {
                $type = new ConfigType();
                $type->setTLabel($label);
                $type->setFormType($formType);
                $output->writeln(sprintf('<info>Create type %s</info>', $formType));
                $typeManager->create($type);
            } else {
                $output->writeln(sprintf('<comment>Type %s already exists.</comment>', $formType));
            }
        }
    }

}