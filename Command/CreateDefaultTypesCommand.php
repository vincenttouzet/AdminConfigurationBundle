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


/**
 * CreateDefaultTypesCommand
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
        $types = array(
            'text' => 'Text Field',
            'textarea' => 'Text Area',
            'email' => 'Email',
            'checkbox' => 'Boolean',
            'choice' => 'Choice',
            'integer' => 'Integer',
            'number' => 'Number',
            'money' => 'Price',
            'percent' => 'Percent',
            'url' => 'Url',
            'datetime' => 'DateTime',
            'date' => 'Date',
            'time' => 'Time',
            'ckeditor' => 'WYSIWYG editor',
            'bootstrap_datepicker' => 'DatePicker',
            'bootstrap_timepicker' => 'TimePicker',
            'bootstrap_datetimepicker' => 'DateTimePicker',
            'bootstrap_email' => 'Bootstrap Email',
            'bootstrap_money' => 'Bootstrap Price',
            'bootstrap_percent' => 'Bootstrap Percent',
            'bootstrap_daterangepicker' => 'DateRangePicker',
            'bootstrap_colorpicker' => 'ColorPicker',
            'bootstrap_slider' => 'Slider',
            'bootstrap_chosen' => 'Chosen',
            'knob' => 'Knob',
        );

        $configBuilder = $this->getContainer()->get('admin.configuration.configbuilder');

        foreach ($types as $formType => $label) {
            $created = $configBuilder->addType(
                $formType,
                $label,
                $formType
            );
            if ( $created ) {
                $output->writeln(sprintf('<info>Create type %s</info>', $formType));
            } else {
                $output->writeln(sprintf('<comment>Type %s already exists.</comment>', $formType));
            }
        }
    }

}