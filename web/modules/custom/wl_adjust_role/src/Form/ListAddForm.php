<?php

namespace Drupal\wl_adjust_role\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\contact\Entity\Message;

/**
 * Provides a wl_adjust_role form.
 */
class ListAddForm extends FormBase
{

  /**
   * {@inheritdoc}
   */
  public function getFormId()
  {
    return 'wl_adjust_role_list_add';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state)
  {

    $entities = [];
    foreach (\Drupal::routeMatch()->getParameters() as $param) {
      if ($param instanceof \Drupal\Core\Entity\EntityInterface) {
        $entities[] = $param;
      }
    }
    $product_id = reset($entities)->id();
    $product_title = reset($entities)->getTitle();


    $user_id  = \Drupal::currentUser()->id();
    $query = \Drupal::entityQuery('default');
    $query->condition('uid', $user_id);
    $query->condition('type', 'matbaa');
    $list_ids = $query->execute();

    $lists =  \Drupal::entityTypeManager()->getStorage('default')->loadMultiple($list_ids);
    $options = [];
    foreach ($lists as $list) {

      $query = \Drupal::entityQuery('default');
      $query->condition('type', 'urun_liste');
      $query->condition('field_urun', $product_id);
      $query->condition('field_liste', $list->id());
      $search_relation = $query->execute();
      if (!$search_relation) {
        $options[$list->id()] = $list->label();
      }
    }





    $form['relation_title'] = [
      '#type' => 'hidden',
      '#value' => $product_title,
    ];

    $form['product_id'] = [
      '#type' => 'hidden',
      '#value' => $product_id,
      '#readonly' => TRUE,
    ];

    $form['list_id'] = [
      '#type' => 'select',
      '#title' => $this->t('Listelerim'),
      '#options' => $options,
    ];

    $form['actions'] = [
      '#type' => 'actions',
    ];
    $form['actions']['submit'] = [
      '#type' => 'submit',
      '#value' => $this->t('Send'),
    ];

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function validateForm(array &$form, FormStateInterface $form_state)
  {
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state)
  {

    $product_id = $form_state->getValue("product_id");
    $list_id = $form_state->getValue("list_id");
    $relation_title = $form_state->getValue("relation_title");

    $data = [
      'type' => 'urun_liste',
      'title' => $relation_title . "- Liste(" . $list_id . ")",
      'field_liste' => $list_id,
      'field_urun' => $product_id
    ];
    $node = \Drupal::entityTypeManager()
      ->getStorage('default')
      ->create($data);
    $node->save();
  }
}
