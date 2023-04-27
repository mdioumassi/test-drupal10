<?php

namespace Drupal\offer\Form;

use Drupal\Core\Entity\ContentEntityForm;
use Drupal\Core\Form\FormStateInterface;

class OfferAddFormStep3 extends ContentEntityForm
{
  public function buildForm(array $form, FormStateInterface $form_state) {
    $form =  parent::buildForm($form, $form_state);
    $form['actions']['submit']['#value'] = t('Save and proceed');
    unset($form['actions']['delete']);
    $form['field_prix']['#states'] = [
      'visible' => [
        ['select[name="field_offer_type"]' => ['value' => 'avec_minimum']],
      ]
    ];
    return $form;
  }

  protected function actions(array $form, FormStateInterface $form_state) {
    $actions = parent::actions($form, $form_state);
    $actions['go_back'] = [
      '#type' => 'submit',
      '#value' => $this->t('Back to step 2'),
      '#submit' => ['::goBack'],
      '#weight' => 90,
      '#limit_validation_errors' => []
    ];
    if (array_key_exists('delete', $actions)) {
      unset($actions['delete']);
    }
    $actions['#prefix'] = '<i>Step 3 of 3</i>';
    return $actions;
  }

  public function cancelSubmit(array $form, FormStateInterface $form_state) {
    $form_state->setRedirect('entity.offer.collection');
  }

  public function goBack(array $form, FormStateInterface $form_state) {
    $entity = $this->getEntity();
    $id = $entity->id();
    $form_state->setRedirect('offer.step2', ['offer' => $id]);
  }
   public function save(array $form, FormStateInterface $form_state) {
     // Redirect to offer overview after save.
     $form_state->setRedirect('entity.offer.collection');
     \Drupal::messenger()->addMessage('Your offer was created. Click the publish button to start earning.');
     $entity = $this->getEntity();
   }

}
