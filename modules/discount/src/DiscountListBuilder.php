<?php

namespace Drupal\commerce_discount;

use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Entity\EntityListBuilder;

/**
 * Defines the list builder for discounts.
 */
class DiscountListBuilder extends EntityListBuilder {

  /**
   * {@inheritdoc}
   */
  public function buildHeader() {
    $header['name'] = t('Name');
    $header['status'] = t('Enabled');
    return $header + parent::buildHeader();
  }

  /**
   * {@inheritdoc}
   */
  public function buildRow(EntityInterface $entity) {
    $row['name'] = $entity->label();
    $row['status'] = $entity->isEnabled() ? $this->t('Enabled') : $this->t('Disabled');

    return $row + parent::buildRow($entity);
  }

}
