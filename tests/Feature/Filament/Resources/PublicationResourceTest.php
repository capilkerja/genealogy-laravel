<?php

namespace Tests\Feature\Filament\Resources;

use App\Filament\Resources\PublicationResource;
use App\Models\Publication;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PublicationResourceTest extends TestCase
{
    use RefreshDatabase;

    public function test_model_association(): void
    {
        $this->assertEquals(Publication::class, PublicationResource::getModel());
    }

    public function test_form_fields(): void
    {
        $form = PublicationResource::form([])->getSchema();

        $nameField = collect($form)->firstWhere('name', 'name');
        $this->assertNotNull($nameField);
        $this->assertTrue($nameField->isRequired());
        $this->assertEquals(255, $nameField->getMaxLength());

        $descriptionField = collect($form)->firstWhere('name', 'description');
        $this->assertNotNull($descriptionField);
        $this->assertTrue($descriptionField->isRequired());
        $this->assertEquals(255, $descriptionField->getMaxLength());

        $isActiveField = collect($form)->firstWhere('name', 'is_active');
        $this->assertNotNull($isActiveField);
        $this->assertTrue($isActiveField->isRequired());
        $this->assertTrue($isActiveField->isNumeric());
    }

    public function test_table_columns(): void
    {
        $columns = PublicationResource::table([])->getColumns();

        $nameColumn = collect($columns)->firstWhere('name', 'name');
        $this->assertTrue($nameColumn->isSearchable());

        $descriptionColumn = collect($columns)->firstWhere('name', 'description');
        $this->assertTrue($descriptionColumn->isSearchable());

        $isActiveColumn = collect($columns)->firstWhere('name', 'is_active');
        $this->assertTrue($isActiveColumn->isNumeric());
        $this->assertTrue($isActiveColumn->isSortable());

        $createdAtColumn = collect($columns)->firstWhere('name', 'created_at');
        $this->assertTrue($createdAtColumn->isSortable());
        $this->assertTrue($createdAtColumn->isToggleable());

        $updatedAtColumn = collect($columns)->firstWhere('name', 'updated_at');
        $this->assertTrue($updatedAtColumn->isSortable());
        $this->assertTrue($updatedAtColumn->isToggleable());
    }
}
