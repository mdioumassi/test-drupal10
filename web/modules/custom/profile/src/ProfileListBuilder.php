<?php

namespace Drupal\profile;

use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Entity\EntityListBuilder;

class ProfileListBuilder extends EntityListBuilder
{
  public function buildHeader() {
    $header['gender'] = t('label');
    $header['last_name'] = t('Last Name');
    $header['first_name'] = t('First Name');
    $header['birth_day'] = t('Birth Date');
    return $header+parent::buildHeader();
  }

  public function buildRow(EntityInterface $entity) {
    $row['gender'] = $entity->gender->value;
    $row['last_name'] = $entity->last_name->value;
    $row['first_name'] = $entity->first_name->value;
    $row['birth_day'] = $entity->birth_day->value;
    return $row+parent::buildRow($entity);
  }

}
