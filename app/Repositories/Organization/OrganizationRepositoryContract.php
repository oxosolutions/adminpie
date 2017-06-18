<?php 
namespace App\Repositories\Organization;

interface OrganizationRepositoryContract{
	
	public function create_organization_migration_tables($org_id);
}
