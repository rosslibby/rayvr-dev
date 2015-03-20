<?php namespace RAYVR\Storage\Code;

class EloquentCodeRepository implements CodeRepository {

	public function all()
	{
		return Code::all();
	}

	public function find($id)
	{
		return Code::find($id);
	}

	public function create($input)
	{
		return Code::create($input);
	}

	public function loadCSV($file)
	{
		$csvFile = $file;

		$csv = $this->readCSV($csvFile);

		foreach($csv as $listings)
		{
			$item = new Item;
			$item->name = $listings[0];
			$item->price = $listings[1];
			$item->cat = $listings[2];

			$item->save();
			echo $listings[0] . 'record added <br />';
		}
		echo 'done';
	}

	public function readCSV($csvFile)
	{
		$file_handle = fopen($csvFile, 'r');
		while(!feof($file_handle))
		{
			$line_of_text[] = fgetcsv($file_handle, 1024);
		}
		fclose($file_handle);
		return $line_of_text;
	}
}