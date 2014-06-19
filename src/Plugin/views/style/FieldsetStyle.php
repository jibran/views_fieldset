<?php

/**
 * @file
 * Contains \Drupal\views_fieldset\Plugin\views\style\FieldsetStyle.
 */

namespace Drupal\views_fieldset\Plugin\views\style;

use Drupal\views\Plugin\views\style\StylePluginBase;

/**
 * Fieldset style plugin to render rows as fieldset.
 *
 * @ingroup views_style_plugins
 *
 * @ViewsStyle(
 *   id = "fieldset",
 *   title = @Translation("Fieldset"),
 *   help = @Translation("Renders the full views output in a fieldset."),
 *   theme = "views_view_fieldset",
 *   display_types = {"normal"}
 * )
 */
class FieldsetStyle extends StylePluginBase {

  /**
   * Does the style plugin allows to use style plugins.
   *
   * @var bool
   */
  protected $usesRowPlugin = TRUE;

  /**
   * Does the style plugin support custom css class for the rows.
   *
   * @var bool
   */
  protected $usesRowClass = TRUE;

  /**
   * Does the style plugin support grouping of rows.
   *
   * @var bool
   */
  protected $usesGrouping = FALSE;

  /**
   * Does the style plugin for itself support to add fields to it's output.
   *
   * This option only makes sense on style plugins without row plugins, like
   * for example table.
   *
   * @var bool
   */
  protected $usesFields = TRUE;

  /**
   * {@inheritdoc}
   */
  protected function defineOptions() {

    $options = parent::defineOptions();
    $options['title'] = array('default' => '');
    $options['description'] = array('default' => '');

    return $options;
  }

  /**
   * {@inheritdoc}
   */
public function buildOptionsForm(&$form, &$form_state) {

    parent::buildOptionsForm($form, $form_state);
    $options = array('' => t('- None -'));
    $field_labels = $this->displayHandler->getFieldLabels(TRUE);
    $options += $field_labels;

    $form['title'] = array(
      '#type' => 'select',
      '#title' => t('Fieldset Title'),
      '#options' => $options,
      '#default_value' => $this->options['title'],
      '#description' => t('Choose the title of fieldset.'),
      '#weight' => -48,
    );

    $form['description'] = array(
      '#type' => 'select',
      '#title' => t('Fieldset Description'),
      '#options' => $options,
      '#default_value' => $this->options['description'],
      '#description' => t('Optional fieldset description.'),
      '#weight' => -47,
    );
  }

}
