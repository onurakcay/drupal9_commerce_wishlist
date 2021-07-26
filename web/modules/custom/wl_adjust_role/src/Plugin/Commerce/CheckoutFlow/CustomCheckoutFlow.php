<?php

namespace Drupal\wl_adjust_role\Plugin\Commerce\CheckoutFlow;

use Drupal\commerce_checkout\Plugin\Commerce\CheckoutFlow\CheckoutFlowWithPanesBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * @CommerceCheckoutFlow(
 *  id = "custom_checkout_flow",
 *  label = @Translation("Custom checkout flow"),
 * )
 */
class CustomCheckoutFlow extends CheckoutFlowWithPanesBase
{
    /**
     * {@inheritdoc}
     */
    public function getSteps()
    {
        return [
            'login' => [
                'label' => $this->t('Login'),
                'next_label' => $this->t('Let user login'),
                'has_order_summary' => FALSE,
            ],
            'select_seat' => [
                'label' => $this->t('Select Seat'),
                'next_label' => $this->t('select seat'),
                'has_order_summary' => FALSE,
            ],
            'order_information' => [
                'label' => $this->t('Order Information'),
                'next_label' => $this->t('See order info'),
                'has_order_summary' => FALSE,
            ],
            'review' => [
                'label' => $this->t('Review'),
                'next_label' => $this->t('review'),
                'has_order_summary' => FALSE,
            ],
            'payment' => [
                'label' => $this->t('Payment'),
                'next_label' => $this->t('Pay and complete purchase'),
                'has_sidebar' => FALSE,
                'hidden' => TRUE,
            ],
            'complete' => [
                'label' => $this->t('Complete'),
                'next_label' => $this->t('Complete checkout'),
                'has_sidebar' => FALSE,
            ],
        ];
    }
}
