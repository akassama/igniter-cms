<?php

namespace App\Models;

use CodeIgniter\Model;
/**
 * ThemesModel class
 *
 * Represents the model for the themes table in the database.
 */
class ThemesModel extends Model
{
    protected $table            = 'themes';
    protected $primaryKey       = 'theme_id';
    protected $useAutoIncrement = false;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields = [
        'theme_id', 
        'name',
        'path', 
        'default_color',
        'heading_color',
        'accent_color',
        'surface_color',
        'contrast_color',
        'background_color',
        'image',
        'theme_url',
        'category',
        'sub_category',
        'selected',
        'override_default_style',
        'use_static_theme_nav',
        'deletable',
        'created_by',
        'updated_by'
    ];

    protected bool $allowEmptyInserts = false;
    protected bool $updateOnlyChanged = true;

    protected array $casts = [];
    protected array $castHandlers = [];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules = [
        'name' => 'required|max_length[100]|is_unique[themes.name]',
        'path' => 'required|max_length[255]|is_unique[themes.path]',
    ];
    protected $validationMessages   = [
        'path' => 'path is required',
        'name' => 'name is required',
    ];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];

    public function createTheme($param = array())
    {
        $data = [
            'theme_id' => getGUID(),
            'name' => $param['name'],
            'path' => $param['path'],
            'default_color' => $param['default_color'],
            'heading_color' => $param['heading_color'],
            'accent_color' => $param['accent_color'],
            'contrast_color' => $param['contrast_color'],
            'surface_color' => $param['surface_color'],
            'background_color' => $param['background_color'],
            'image' => $param['image'],
            'theme_url' => $param['theme_url'],
            'category' => $param['category'],
            'sub_category' => $param['sub_category'],
            'selected' => $param['selected'],
            'override_default_style' => $param['override_default_style'],
            'use_static_theme_nav' => $param['use_static_theme_nav'],
            'deletable' => $param['deletable'],
            'created_by' => $param['created_by'],
            'updated_by' => $param['updated_by']
        ];
        $this->save($data);

        return true;
    }

    public function updateTheme($themeId, $param = [])
    {
        // Check if record exists
        $existingTheme = $this->find($themeId);
        if (!$existingTheme) {
            return false; // not found
        }

        // Update the fields
        $existingTheme['name'] = $param['name'];
        $existingTheme['path'] = $param['path'];
        $existingTheme['default_color'] = $param['default_color'];
        $existingTheme['heading_color'] = $param['heading_color'];
        $existingTheme['accent_color'] = $param['accent_color'];
        $existingTheme['surface_color'] = $param['surface_color'];
        $existingTheme['contrast_color'] = $param['contrast_color'];
        $existingTheme['background_color'] = $param['background_color'];
        $existingTheme['image'] = $param['image'];
        $existingTheme['theme_url'] = $param['theme_url'];
        $existingTheme['category'] = $param['category'];
        $existingTheme['sub_category'] = $param['sub_category'];
        $existingTheme['selected'] = $param['selected'];
        $existingTheme['override_default_style'] = $param['override_default_style'];
        $existingTheme['use_static_theme_nav'] = $param['use_static_theme_nav'];
        $existingTheme['deletable'] = $param['deletable'];
        $existingTheme['created_by'] = $param['created_by'];
        $existingTheme['updated_by'] = $param['updated_by'];

        // Save the updated data
        $this->save($existingTheme);

        return true;
    }
}
