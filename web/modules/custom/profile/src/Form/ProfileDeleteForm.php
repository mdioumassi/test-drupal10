<?php

namespace Drupal\profile\Form;

use Drupal\Core\Entity\ContentEntityConfirmFormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Url;

class ProfileDeleteForm extends ContentEntityConfirmFormBase
{

  public function getQuestion() {
    return $this->t('Etes vous sur de supprimer %name entity ?', ['%name' => $this->entity->label()]);
  }

  public function getCancelUrl() {
    return new Url('entity.profile.collection');
  }

  public function getConfirmText() {
    return $this->t('Supprimer');
  }

  public function submitForm(array &$form, FormStateInterface $form_state) {
    $entity = $this->getEntity();
    $entity->delete();
    \Drupal::logger('profile')->notice('@type: deleted %title', ['%title' => $this->entity->label()]);
    $form_state->setRedirect('entity.profile.collection');
  }

}
