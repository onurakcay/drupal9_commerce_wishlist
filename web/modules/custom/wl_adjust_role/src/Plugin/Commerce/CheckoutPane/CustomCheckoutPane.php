<?php

namespace Drupal\wl_adjust_role\Plugin\Commerce\CheckoutPane;

use Drupal\commerce_checkout\Plugin\Commerce\CheckoutPane\CheckoutPaneBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Provides a custom message pane.
 *
 * @CommerceCheckoutPane(
 *   id = "my_checkout_pane_custom_message",
 *   label = @Translation("Custom message"),
 * )
 */


class CustomCheckoutPane extends CheckoutPaneBase
{

    /**
     * {@inheritdoc}
     */
    public function buildPaneForm(array $pane_form, FormStateInterface $form_state, array &$complete_form)
    {
        $pane_form['test'] = [
            '#type' => 'checkbox',
            '#title' => $this->t('Devam ?'),
        ];
        return $pane_form;
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

        ksm($form_state->getValues());
    }
}
