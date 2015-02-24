<?php namespace RAYVR\Storage\Code;

interface CodeRepository {

	public function all();

	public function find($id);

	public function create($input);

	/**
	 * Courtesy of:
	 * 
	 * http://www.laravelmy.com/2014/02/15/exporting-csv-file-to-database-in-laravel-4-1/
	 */
	public function loadCSV($file);

	public function readCSV($csvFile);
}