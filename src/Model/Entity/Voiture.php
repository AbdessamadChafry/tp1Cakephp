<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Voiture Entity
 *
 * @property int $id
 * @property int $user_id
 * @property string $marque
 * @property string $slug
 * @property string|null $body
 * @property bool|null $published
 * @property \Cake\I18n\FrozenTime|null $created
 * @property \Cake\I18n\FrozenTime|null $modified
 *
 * @property \App\Model\Entity\User $user
 * @property \App\Model\Entity\Offre[] $offres
 * @property \App\Model\Entity\Tag[] $tags
 */
class Voiture extends Entity
{
    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array
     */
    protected $_accessible = [
        'user_id' => true,
        'marque' => true,
        'slug' => true,
        'body' => true,
        'published' => true,
        'created' => true,
        'modified' => true,
        'user' => true,
        'offres' => true,
        'tags' => true,
        'files' => true,
    ];
}
