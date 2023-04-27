<?php

namespace Drupal\exemple\Form;

use Drupal\Core\Entity\ContentEntityForm;
use Drupal\Core\Form\FormStateInterface;

/**
 * Form controller for the exemple entity edit forms.
 */
class ExempleForm extends ContentEntityForm {

  /**
   * {@inheritdoc}
   */
  public function save(array $form, FormStateInterface $form_state) {
    $result = parent::save($form, $form_state);

    $entity = $this->getEntity();

    $message_arguments = ['%label' => $entity->toLink()->toString()];
    $logger_arguments = [
      '%label' => $entity->label(),
      'link' => $entity->toLink($this->t('View'))->toString(),
    ];

    switch ($result) {
      case SAVED_NEW:
        $this->messenger()->addStatus($this->t('New exemple %label has been created.', $message_arguments));
        $this->logger('exemple')->notice('Created new exemple %label', $logger_arguments);
        break;

      case SAVED_UPDATED:
        $this->messenger()->addStatus($this->t('The exemple %label has been updated.', $message_arguments));
        $this->logger('exemple')->notice('Updated exemple %label.', $logger_arguments);
        break;
    }

    $form_state->setRedirect('entity.exemple.canonical', ['exemple' => $entity->id()]);

    return $result;
  }

}
