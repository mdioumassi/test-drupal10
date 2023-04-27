<?php

namespace Drupal\offer\Form;

use Drupal\Core\Entity\ContentEntityForm;
use Drupal\Core\Form\FormStateInterface;

class OfferForm extends ContentEntityForm
{
  public function buildForm(array $form, FormStateInterface $form_state) {
    $form =  parent::buildForm($form, $form_state);
    return $form;
  }

   public function save(array $form, FormStateInterface $form_state) {
     $entity = $this->getEntity();
     $entity->save();
     $form_state->setRedirect('entity.offer.collection');
   }

}
