<?php

class produkt_constructor {
	private $con;
	private $id;

	public function __construct($con, $id) {
			$this->con = $con;
			$this->id = $id;

	$query = mysqli_query($this->con, "SELECT * FROM proizvodi WHERE id='$this->id'");
			$produkt = mysqli_fetch_array($query);

			$this->ime = $produkt['ime'];
			$this->kategorija = $produkt['kategorija'];
			$this->opis = $produkt['opis'];
			$this->kolicina = $produkt['kolicina'];
			$this->cijena = $produkt['cijena'];
			$this->slika = $produkt['slika'];		

	}

	public function getIme() {
		return $this->ime;
	}
	public function getOpis() {
		return $this->opis;
	}
	public function getSlika() {
		return $this->slika;
	}
	public function getKolicina() {
		return $this->kolicina;
	}
	public function getCijena() {
		return $this->cijena;
	}

	public function getKategorija() {
		$kategorijaQuery = mysqli_query($this->con, "SELECT ime_kategorija FROM kategorije WHERE id='$this->kategorija'");
		$kategorija = mysqli_fetch_array($kategorijaQuery);
		return $kategorija['ime_kategorija'];
	}
}	

?>