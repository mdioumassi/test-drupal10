<?php
namespace Drupal\offer;


use Drupal\views\EntityViewsData;

class OfferViewsData extends EntityViewsData
{
  public function getViewsData() {
    $data =  parent::getViewsData();
    $data['offer']['offer_entity_moderation_state_views_field'] = [
      'title' => t('Moderation status'),
      'field' => array(
        'title' => t('Moderation status'),
        'help' => t('Shows the state of the offer entity.'),
        'id' => 'offer_entity_moderation_state_views_field',
      ),
    ];

    $data['offer']['offer_dynamic_operation_links'] = [
      'title' => t('Dynamic operations'),
      'field' => array(
        'title' => t('Dynamic operations'),
        'help' => t('Shows a dropbutton with dynamic operations for offers.'),
        'id' => 'offer_dynamic_operation_links',
      ),
    ];
    return $data;
  }

}
