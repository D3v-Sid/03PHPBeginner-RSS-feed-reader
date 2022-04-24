<?php

class Articles{
    public string $title;
    public string $fullDescription;
    public string $short_description;
    public $date;
    public $imageURL;
    public $link;

    public function __construct(object $xmlObject){
        $this->title =  $xmlObject->title;
        $this->fullDescription = $xmlObject->description ;
        $this->short_description = substr($this->fullDescription,0, strpos( $this->fullDescription, "</p>"));
        $this->date = date('d/m/Y',strtotime( $$xmlObject->pubDate));
        $this->imageURL = $xmlObject->channel->image->url;
        $this->link = $xmlObject->link;
    }
    
    public function display(){
        print("
        <article>
            <hgroup>
                <h3> $this->title </h3>
                <h5> $this->date </h5>
            </hgroup>
            <div class='grid>
                <img src='$this->imageURL' height=150 width =100>
                <p>$this->short_description</p>
            </div>
        </article>
        " );
    }


}

?>