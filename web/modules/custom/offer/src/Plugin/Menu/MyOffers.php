<?php

namespace Drupal\offer\Plugin\Menu;

use Drupal\Core\Database\Connection;
use Drupal\Core\Menu\MenuLinkDefault;
use Drupal\Core\Menu\StaticMenuLinkOverridesInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * A menu link that displays count of messages.
 */
class MyOffers extends MenuLinkDefault {

  /**
   * The database connection.
   *
   * @var \Drupal\Core\Database\Connection
   */
  protected $dbConnection;

  /**
   * Constructs the plugin object.
   *
   * @param array $configuration
   *   A configuration array containing information about the plugin instance.
   * @param string $plugin_id
   *   The plugin_id for the plugin instance.
   * @param mixed $plugin_definition
   *   The plugin implementation definition.
   * @param \Drupal\Core\Menu\StaticMenuLinkOverridesInterface $static_override
   *   The static override storage.
   * @param \Drupal\Core\Database\Connection $db_connection
   *   The database connection.
   */
  public function __construct(array $configuration, $plugin_id, $plugin_definition, StaticMenuLinkOverridesInterface $static_override, Connection $db_connection) {
    parent::__construct($configuration, $plugin_id, $plugin_definition, $static_override);
    $this->dbConnection = $db_connection;
  }

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container, array $configuration, $plugin_id, $plugin_definition) {
    return new static(
      $configuration,
      $plugin_id,
      $plugin_definition,
      $container->get('menu_link.static.overrides'),
      $container->get('database')
    );
  }

  /**
   * {@inheritdoc}
   */
  public function getTitle() {
    $count = 0;
    if (\Drupal::currentUser()->isAuthenticated()) {
      $offers = \Drupal::entityTypeManager()
        ->getStorage('offer')
        ->loadByProperties(['user_id' => \Drupal::currentUser()->id()]);
      $count = count($offers);
      return $this->t('My offers (<span class="count-badge">@count</span>)', ['@count' => $count]);
    }
    else {
      return NULL;
    }
  }

  public function getCacheMaxAge() {
    return 0;
  }

}
