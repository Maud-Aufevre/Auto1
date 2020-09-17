<?php

class Vehicule{
    private $id_veh;
    private $marque;
    private $modele;
    private $pays;
    private $prix;
    private $image;
    private $description;
    private $annee;
    private $date_veh;
    private $id_cat;

    /**
     * Get the value of id_veh
     */ 
    public function getId_veh()
    {
        return $this->id_veh;
    }

    /**
     * Set the value of id_veh
     *
     * @return  self
     */ 
    public function setId_veh($id_veh)
    {
        $this->id_veh = $id_veh;

        return $this;
    }

    /**
     * Get the value of marque
     */ 
    public function getMarque()
    {
        return $this->marque;
    }

    /**
     * Set the value of marque
     *
     * @return  self
     */ 
    public function setMarque($marque)
    {
        $this->marque = $marque;

        return $this;
    }

    /**
     * Get the value of modele
     */ 
    public function getModele()
    {
        return $this->modele;
    }

    /**
     * Set the value of modele
     *
     * @return  self
     */ 
    public function setModele($modele)
    {
        $this->modele = $modele;

        return $this;
    }

    /**
     * Get the value of pays
     */ 
    public function getPays()
    {
        return $this->pays;
    }

    /**
     * Set the value of pays
     *
     * @return  self
     */ 
    public function setPays($pays)
    {
        $this->pays = $pays;

        return $this;
    }

    /**
     * Get the value of prix
     */ 
    public function getPrix()
    {
        return $this->prix;
    }

    /**
     * Set the value of prix
     *
     * @return  self
     */ 
    public function setPrix($prix)
    {
        $this->prix = $prix;

        return $this;
    }

    /**
     * Get the value of image
     */ 
    public function getImage()
    {
        return $this->image;
    }

    /**
     * Set the value of image
     *
     * @return  self
     */ 
    public function setImage($image)
    {
        $this->image = $image;

        return $this;
    }

    /**
     * Get the value of description
     */ 
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set the value of description
     *
     * @return  self
     */ 
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get the value of annee
     */ 
    public function getAnnee()
    {
        return $this->annee;
    }

    /**
     * Set the value of annee
     *
     * @return  self
     */ 
    public function setAnnee($annee)
    {
        $this->annee = $annee;

        return $this;
    }

    /**
     * Get the value of date_veh
     */ 
    public function getDate_veh()
    {
        return $this->date_veh;
    }

    /**
     * Set the value of date_veh
     *
     * @return  self
     */ 
    public function setDate_veh($date_veh)
    {
        $this->date_veh = $date_veh;

        return $this;
    }

    /**
     * Get the value of id_cat
     */ 
    public function getId_cat()
    {
        return $this->id_cat;
    }

    /**
     * Set the value of id_cat
     *
     * @return  self
     */ 
    public function setId_cat($id_cat)
    {
        $this->id_cat = $id_cat;

        return $this;
    }
}