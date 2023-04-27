<?php

namespace Drupal\offer\Form;

use Drupal\bid\Entity\Bid;
use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Provides a offer form.
 */
class OfferBiddingForm extends FormBase {

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'offer_bid_form';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state, $offer = NULL) {
    switch($offer->get('field_offer_type')->getString()) {
      case 'avec_minimum':
        $price = $offer->get('field_prix')->getString();
        break;
      case 'sans_minimum';
        $price = '0';
        break;
    }

    $form['prix'] = [
      '#markup' => '<h2>' . $this->t('Start bidding at @price$', ['@price' => $price]) . '</h2>',
    ];
    $form['offer_id'] = [
      '#type' => 'hidden',
      '#value' => $offer->id(),
      '#access' => FALSE
    ];

    $form['bid'] = [
      '#type' => 'textfield',
      '#attributes' => array(
        ' type' => 'number',
        ' min' => $price
      ),
      '#title' => $this->t('Your bid'),
      '#description' => $this->t('Prices in $.'),
      '#required' => TRUE,
    ];

    $form['actions'] = [
      '#type' => 'actions',
    ];
    $form['actions']['submit'] = [
      '#type' => 'submit',
      '#value' => $this->t('Submit'),
    ];

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function validateForm(array &$form, FormStateInterface $form_state) {
    if (!is_numeric($form_state->getValue('bid'))) {
      $form_state->setErrorByName('bid', t('Bid input needs to be numeric.'));
    }
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    $bid = Bid::create([
      'bid' => $form_state->getValue('bid'),
      'user_id' => ['target_id' => \Drupal::currentUser()->id()],
      'offer_id' => ['target_id' => $form_state->getValue('offer_id')]
    ]);
    $bid->save();
    \Drupal::messenger()->addMessage($this->t('Your bid was successfully submitted.'));;
  }

}
