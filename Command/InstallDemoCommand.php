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

/**
 * InstallDemoCommand
 *
 * @category VinceT
 * @package  VinceTAdminConfigurationBundle
 * @author   Vincent Touzet <vincent.touzet@gmail.com>
 * @license  MIT License view the LICENSE file that was distributed with this source code.
 * @link     https://github.com/vincenttouzet/AdminBundle
 */
class InstallDemoCommand extends ContainerAwareCommand
{
    protected $output;
    protected $configBuilder;
    /**
     * configure command
     *
     * @return null
     */
    protected function configure()
    {
        parent::configure();
        $this
            ->setName('vincet:admin-configuration:install-demo')
            ->setDescription('Install some demo values')
            ->setHelp(
<<<EOF
The <info>vincet:admin-configuration:install-demo</info> command create a section and a group with some values.
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
        $this->output = $output;
        $this->configBuilder = $this->getContainer()->get('admin.configuration.configbuilder');

        $this->configBuilder->addSection('demo', 'Demo');
        $this->configBuilder->addGroup('demo', 'demo', 'Demo');

        $types = array(
            'text' => 'Text Field',
            'textarea' => 'Text Area',
            'email' => 'Email',
            'checkbox' => 'Boolean',
            'choice' => 'Choice',
            'integer' => 'Integer',
            'number' => 'Number',
            'money' => 'Money',
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

        // text field
        $this->_createValue('demo_text', 'text', 'Text field', '', '', array(), 0);
        $this->_createValue('demo_textarea', 'textarea', 'Text area', '', '', array(), 1);
        $this->_createValue('demo_email', 'email', 'Email', '', '', array(), 2);
        $this->_createValue('demo_bootstrap_email', 'bootstrap_email', 'Email', '', '', array(), 2);
        $this->_createValue('demo_checkbox', 'checkbox', 'Checkbox', '', '', array(), 3);
        $this->_createValue('demo_integer', 'integer', 'Integer', '', '', array(), 4);
        $this->_createValue('demo_number', 'number', 'Number', '', '', array(), 5);
        $this->_createValue('demo_money', 'money', 'Money', '', '', array(), 6);
        $this->_createValue('demo_bootstrap_money', 'bootstrap_money', 'Money', '', '', array(), 6);
        $this->_createValue('demo_percent', 'percent', 'Percent', '', '', array(), 7);
        $this->_createValue('demo_bootstrap_percent', 'bootstrap_percent', 'Percent', '', '', array(), 7);
        $this->_createValue('demo_url', 'url', 'Url', '', '', array(), 8);
        $this->_createValue('demo_datetime', 'datetime', 'Datetime', '', '', array(), 9);
        $this->_createValue('demo_date', 'date', 'Date', '', '', array(), 10);
        $this->_createValue('demo_time', 'time', 'Time', '', '', array(), 11);
        $this->_createValue('demo_ckeditor', 'ckeditor', 'Wysisyg', '', '', array(), 12);
        $this->_createValue('demo_bootstrap_datepicker', 'bootstrap_datepicker', 'DatePicker', '', '', array(), 13);
        $this->_createValue('demo_bootstrap_timepicker', 'bootstrap_timepicker', 'TimePicker', '', '', array(), 14);
        $this->_createValue('demo_bootstrap_datetimepicker', 'bootstrap_datetimepicker', 'DateTimePicker', '', '', array(), 15);
        $this->_createValue('demo_bootstrap_daterangepicker', 'bootstrap_daterangepicker', 'DateRangePicker', '', '', array(), 16);
        $this->_createValue('demo_bootstrap_colorpicker', 'bootstrap_colorpicker', 'ColorPicker', '', '', array(), 17);
        $this->_createValue('demo_bootstrap_slider', 'bootstrap_slider', 'Slider', '', '', array(), 18);
        $this->_createValue('demo_bootstrap_slider_deux', 'bootstrap_slider', 'Slider range', '', '', array('range'=>true), 18);
        $this->_createValue('demo_choice', 'choice', 'Choice', '', '', array('choices'=>array('fr'=>'France', 'uk'=>'United Kingdom', 'us'=>'United States')), 3);
        $this->_createValue('demo_bootstrap_chosen', 'bootstrap_chosen', 'Chosen', '', '', array('choices'=>array('fr'=>'France', 'uk'=>'United Kingdom', 'us'=>'United States')), 3);
        $this->_createValue('demo_knob', 'knob', 'Knob', '', '', array(), 19);

    }

    /**
     * Create a value
     *
     * @param string  $name        [description]
     * @param string  $type        [description]
     * @param string  $label       [description]
     * @param string  $value       [description]
     * @param string  $help        [description]
     * @param array   $formOptions [description]
     * @param integer $position    [description]
     *
     * @return Boolean
     */
    private function _createValue($name, $type, $label, $value, $help, $formOptions, $position)
    {
        $created = $this->configBuilder->addValue(
            'demo',
            'demo',
            $name,
            $type,
            $label,
            $value,
            $help,
            $formOptions,
            $position
        );
        if ($created) {
            $this->output->writeln(sprintf('<info>Create value %s:%s:%s</info>', 'demo', 'demo', $name));
        } else {
            $this->output->writeln(sprintf('<comment>Value %s:%s:%s already exists.</comment>', 'demo', 'demo', $name));
        }
    }

}
