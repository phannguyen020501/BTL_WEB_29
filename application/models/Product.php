<?php

class Products {
    //private $id;      
    private $name;
    private $author;  
    private $category;
    private $publisher;
    private $availability;
    private $price;
    private $summary;         
    private $image;
    private $year;
    private $id;       
    
    public function __construct($name,$author,$category,$publisher,$availability, $price,$summary, $image,$year) {
        self::setName($name);
        self::setAuthor($author);
        self::setCategory($category);
        self::setPublisher($publisher);
        self::setAvailability($availability);
        self::setPrice($price);
        self::setSummary($summary);
        self::setImage($image);
        self::setYear($year);
    }
    
    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

     /**
     * @return mixed
     */
    public function getAuthor()
    {
        return $this->author;
    }

     /**
     * @return mixed
     */
    public function getCategory()
    {
        return $this->category;
    }

     /**
     * @return mixed
     */
    public function getPublisher()
    {
        return $this->publisher;
    }


     /**
     * @return mixed
     */
    public function getAvailability()
    {
        return $this->availability;
    }



    /**
     * @return mixed
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * @return mixed
     */
    public function getSummary()
    {
        return $this->summary;
    }


    /**
     * @return mixed
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * @return mixed
     */
    public function getYear()
    {
        return $this->year;
    }

    /**
     * @return mixed
     */
    public function getID()
    {
        return $this->id;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    public function setAuthor($author)
    {
        $this->author = $author;
    }

    public function setCategory($category)
    {
        $this->category = $category;
    }

    public function setPublisher($publisher)
    {
        $this->publisher = $publisher;
    }
    public function setAvailability($availability)
    {
        $this->availability = $availability;
    }

    /**
     * @param mixed $price
     */
    public function setPrice($price)
    {
        $this->price = $price;
    }

    public function setSummary($summary)
    {
        $this->summary = $summary;
    }
    /**
     * @param mixed $image
     */
    public function setImage($image)
    {
        $this->image = $image;
    }
    public function setYear($year)
    {
        $this->year = $year;
    }

    /**
     * @param mixed $image
     */
    public function setID($id)
    {
        $this->id = $id;
    }
}
