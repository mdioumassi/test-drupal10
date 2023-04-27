<?php

namespace Drupal\exemple;

use Drupal\Core\Entity\ContentEntityInterface;
use Drupal\Core\Entity\EntityChangedInterface;
use Drupal\user\EntityOwnerInterface;

/**
 * Provides an interface defining an exemple entity type.
 */
interface ExempleInterface extends ContentEntityInterface, EntityOwnerInterface, EntityChangedInterface {

}
