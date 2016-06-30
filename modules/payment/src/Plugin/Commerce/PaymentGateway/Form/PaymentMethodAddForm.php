<?php

namespace Drupal\commerce_payment\Plugin\Commerce\PaymentGateway\Form;

class PaymentMethodAddForm {

  /**
   * {@inheritdoc}
   */
  public function buildPluginForm(array $plugin_form, FormStateInterface $form_state) {
    $plugin_form['payment_details'] = [
      '#type' => 'container',
    ];
    $plugin_form['billing_information'] = [
      '#type' => 'inline_entity_form',
      '#entity_type' => 'profile',
      '#bundle' => 'billing',
      //'#default_value' => $payment_method->getBillingProfile(),
      '#save_entity' => FALSE,
    ];
    // @todo Needs to be moved to a #process, or a widget setting.
    // Remove the details wrapper from the address field.
    //if (!empty($plugin_form['address']['widget'][0])) {
    //  $plugin_form['address']['widget'][0]['#type'] = 'container';
    //}

    return $plugin_form;
  }

  /**
   * {@inheritdoc}
   */
  public function validatePluginForm(array &$plugin_form, FormStateInterface $form_state, array &$complete_form) {
    $billing_profile = clone $plugin_form['#billing_profile'];
    $form_display = EntityFormDisplay::collectRenderDisplay($billing_profile, 'default');
    $form_display->extractFormValues($billing_profile, $plugin_form, $form_state);
    $form_display->validateFormValues($billing_profile, $plugin_form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  public function submitPluginForm(array &$plugin_form, FormStateInterface $form_state, array &$complete_form) {
    $billing_profile = clone $plugin_form['#billing_profile'];
    $form_display = EntityFormDisplay::collectRenderDisplay($billing_profile, 'default');
    $form_display->extractFormValues($billing_profile, $plugin_form, $form_state);
    $billing_profile->save();
    $this->order->setBillingProfile($billing_profile);
  }

}
