<?php
namespace  Drupal\profile\Entity;
use Drupal\Core\Entity\ContentEntityBase;
use Drupal\Core\Entity\EntityTypeInterface;
use Drupal\Core\Field\BaseFieldDefinition;
use Drupal\profile\ProfileInterface;

/**
 * Defines the profile entity class.
 *
 * The base table name here is plural, despite Drupal table naming standards,
 * because "profile" is a reserved word in many databases.
 *
 * @ContentEntityType(
 *   id = "profile",
 *   label = @Translation("Profile"),
 *   handlers = {
 *     "list_builder" = "Drupal\profile\ProfileListBuilder",
 *     "route_provider" = {
 *       "html" = "Drupal\Core\Entity\Routing\AdminHtmlRouteProvider",
 *     },
 *     "form" = {
 *       "add" = "Drupal\profile\Form\ProfileForm",
 *       "edit" = "Drupal\profile\Form\ProfileForm",
 *       "delete" = "Drupal\profile\Form\ProfileDeleteForm"
 *     },
 *   },
 *   admin_permission = "administer profiles",
 *   base_table = "profile",
 *   data_table = "profile_field_data",
 *   entity_keys = {
 *     "id" = "profile_id",
 *     "uuid" = "uuid"
 *   },
 *   links = {
 *     "canonical" = "/profile/{profile}",
 *     "edit-form" = "/profile/{profile}/edit",
 *     "add-form" = "/profile/add",
 *     "delete-form" = "/admin/profile/{profile}/delete",
 *     "collection" = "/admin/profile",
 *   },
 * )
 */
class Profile extends  ContentEntityBase implements ProfileInterface
{
  public static function baseFieldDefinitions(EntityTypeInterface $entity_type): array {
   $fields['profile_id'] = BaseFieldDefinition::create('integer')
     ->setLabel('Profile ID')
     ->setReadOnly(TRUE)
     ->setSetting('unsigned', TRUE);

    $fields['uuid'] = BaseFieldDefinition::create('uuid')
      ->setLabel(t('UUID'))
      ->setDescription(t('The UUID of the Contact entity.'))
      ->setReadOnly(TRUE);

    $fields['gender'] = BaseFieldDefinition::create('list_string')
      ->setLabel(t('Gender'))
      ->setDescription(t('The gender of the Contact entity.'))
      ->setSettings(array(
        'allowed_values' => array(
          'female' => 'female',
          'male' => 'male',
        ),
      ))
      ->setDisplayOptions('view', array(
        'label' => 'above',
        'type' => 'list_default',
        'weight' => -4,
      ))
      ->setDisplayOptions('form', array(
        'type' => 'options_select',
        'weight' => -4,
      ))
      ->setDisplayConfigurable('form', TRUE)
      ->setDisplayConfigurable('view', TRUE);
    // Firstname
    $fields['first_name'] = BaseFieldDefinition::create('string')
      ->setLabel(t('First Name'))
      ->setSettings(array(
        'default_value' => '',
        'max_length' => 255,
        'text_processing' => 0,
      ))
      ->setDisplayOptions('view', array(
        'label' => 'above',
        'type' => 'string',
        'weight' => -5,
      ))
      ->setDisplayOptions('form', array(
        'type' => 'string_textfield',
        'weight' => -5,
      ))
      ->setDisplayConfigurable('form', TRUE)
      ->setDisplayConfigurable('view', TRUE);

    $fields['last_name'] = BaseFieldDefinition::create('string')
      ->setLabel(t('Last Name'))
      ->setSettings(array(
        'default_value' => '',
        'max_length' => 255,
        'text_processing' => 0,
      ))
      ->setDisplayOptions('view', array(
        'label' => 'above',
        'type' => 'string',
        'weight' => -5,
      ))
      ->setDisplayOptions('form', array(
        'type' => 'string_textfield',
        'weight' => -5,
      ))
      ->setDisplayConfigurable('form', TRUE)
      ->setDisplayConfigurable('view', TRUE);

    $fields['birth_day'] = BaseFieldDefinition::create('datetime')
      ->setLabel(t('Birth date'))
      ->setDescription(t('The Birth date of the profile entity.'))
      ->setSetting('datetime_type', 'date')
      ->setRequired(TRUE)
      ->setDisplayOptions('view', array(
        'label' => 'above',
        'type' => 'string',
        'weight' => -5,
      ))
      ->setDisplayOptions('form', array(
        'type' => 'date',
        'weight' => -5,
      ))
      ->setDisplayConfigurable('form', TRUE)
      ->setDisplayConfigurable('view', TRUE);

    $fields['email'] = BaseFieldDefinition::create('email')
      ->setLabel(t('Email'))
      ->setRequired(TRUE)
      ->setDisplayOptions('view', array(
        'label' => 'above',
        'type' => 'string',
        'weight' => -5,
      ))
      ->setDisplayOptions('form', array(
        'type' => 'string',
        'weight' => -5,
      ))
      ->setDisplayConfigurable('form', TRUE)
      ->setDisplayConfigurable('view', TRUE);

    $fields['created'] = BaseFieldDefinition::create('created')
      ->setLabel(t('Created'))
      ->setDescription(t('The time that the entity was created.'));

    $fields['changed'] = BaseFieldDefinition::create('changed')
      ->setLabel(t('Changed'))
      ->setDescription(t('The time that the entity was last edited.'));

    return $fields;
  }

}
