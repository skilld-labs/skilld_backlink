<?php

namespace Drupal\skilld_backlink\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Provides a block to navigate to previous page.
 *
 * @Block(
 *   id = "skilld_backlink_block",
 *   admin_label = @Translation("Link to previous page"),
 *   category = @Translation("Skilld")
 * )
 */
class BackLinkBlock extends BlockBase {

  /**
   * {@inheritdoc}
   */
  public function defaultConfiguration() {
    return [
      'text' => 'Back to the previous page',
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function blockForm($form, FormStateInterface $form_state) {
    $config = $this->getConfiguration();

    $form['text'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Link text'),
      '#description' => $this->t('Empty text means the usage of default text.'),
      '#default_value' => $config['text'],
    ];
    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function blockSubmit($form, FormStateInterface $form_state) {
    $this->setConfigurationValue('text', $form_state->getValue('text'));
  }

  /**
   * {@inheritdoc}
   */
  public function build() {
    $config = $this->getConfiguration();

    return [
      '#type' => 'inline_template',
      '#template' => '<a href="javascript:history.back()">{{ text }}</a>',
      '#context' => [
        'text' => $config['text'],
      ],
    ];
  }

}
