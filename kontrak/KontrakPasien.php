<?php

  interface KontrakPasienView {
      public function tampil();
      public function index();
  }

  interface KontrakPasienPresenter {
      public function prosesDataPasien();
      public function insertPasien($data);
      public function updatePasien($id, $data);
      public function deletePasien($id);
      public function getId($i);
      public function getNik($i);
      public function getNama($i);
      public function getTempat($i);
      public function getTl($i);
      public function getGender($i);
      public function getEmail($i);
      public function getTelp($i);
      public function getSize();
  }
