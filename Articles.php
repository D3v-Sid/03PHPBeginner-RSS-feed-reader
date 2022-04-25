<?php

class Articles{
    public string $title;
    public string $fullDescription;
    public string $short_description;
    public $date;
    public $imageURL;
    public $link;

    public function __construct(object $item, $imageURL){
        $this->title =  $item->title;
        $this->fullDescription = $item->description ;
        $this->short_description = substr($this->fullDescription,0, strpos( $this->fullDescription, "</p>"));
        $this->date = date('d/m/Y',strtotime( $item->pubDate));
        $this->imageURL = $imageURL;
        $this->link = $item->link;
    }
    
    public function display(){
        print("
        <article>
            <hgroup>
                <h3> $this->title </h3>
                <h5> $this->date </h5>
            </hgroup>
            <div class='grid>
                <img src = '$this->imageURL' height=300 width=200>
                <div>
                    <p>$this->short_description</p>
                    <a href=$this->link> Read More </a> 
                </div>
            </div>
        </article>
        " );
    }


}

?>