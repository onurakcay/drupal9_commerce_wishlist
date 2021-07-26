<?php

namespace Drupal\wl_adjust_role\Plugin\Block;

use Drupal\Core\Block\BlockBase;

/**
 * Provides a listeler block.
 *
 * @Block(
 *   id = "wl_adjust_role_listeler",
 *   admin_label = @Translation("Listeler"),
 *   category = @Translation("Custom")
 * )
 */
class ListelerBlock extends BlockBase
{

  /**
   * {@inheritdoc}
   */
  public function build()
  {
    $form = \Drupal::formBuilder()->getForm('Drupal\wl_adjust_role\Form\ListAddForm');

    return $form;
  }
}
