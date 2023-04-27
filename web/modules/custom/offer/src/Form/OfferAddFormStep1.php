<?php

namespace Drupal\offer\Form;

use Drupal\Core\Entity\ContentEntityForm;
use Drupal\Core\Form\FormStateInterface;

class OfferAddFormStep1 extends ContentEntityForm {

  public function buildForm(array $form, FormStateInterface $form_state) {
    $form = parent::buildForm($form, $form_state);
    $form['actions']['submit']['#value'] = t('Save and proceed');
    return $form;
  }

  protected function actions(array $form, FormStateInterface $form_state) {
    $actions = parent::actions($form, $form_state);
    $actions['cancel'] = [
      '#type' => 'submit',
      '#value' => $this->t('Cancel'),
      '#submit' => ['::cancelSubmit'],
      '#weight' => 90,
      '#limit_validation_errors' => [],
    ];
    if (array_key_exists('delete', $actions)) {
      unset($actions['delete']);
    }
    $actions['#prefix'] = '<i>Step 1 of 3</i>';
    return $actions;
  }

  public function cancelSubmit(array $form, FormStateInterface $form_state) {
    $form_state->setRedirect('entity.offer.collection');
  }

  public function save(array $form, FormStateInterface $form_state) {
    $entity = $this->getEntity();
    $entity->save();
    $id = $entity->id();
    $form_state->setRedirect('offer.step2', ['offer' => $id]);
  }

}
