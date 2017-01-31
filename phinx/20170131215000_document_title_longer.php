<?php

use Phinx\Migration\AbstractMigration;

class DocumentTitleLonger
extends AbstractMigration {

	public function
	Up() {
	/*//
	operations to perform when upgrading the database with this migration.
	//*/

		// barack obama had some stupid long titles and the default in mysql
		// is now to error out instead of truncate because thanks obama.

		$this->Execute(<<< LOL
ALTER TABLE `documents`
CHANGE COLUMN `doc_title` `doc_title` VARCHAR(512) NULL DEFAULT NULL COMMENT 'Title - name of document' AFTER `doc_date_signed`;
LOL
		);

		return;
	}

	public function
	Down() {
	/*//
	operations to perform when downgrading the database with this migration.
	//*/

		$this->Execute(<<< LOL
ALTER TABLE `documents`
CHANGE COLUMN `doc_title` `doc_title` VARCHAR(256) NULL DEFAULT NULL COMMENT 'Title - name of document' AFTER `doc_date_signed`;
LOL
		);

		return;
	}

}
