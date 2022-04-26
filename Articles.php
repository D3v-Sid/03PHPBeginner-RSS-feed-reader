<?php

class Articles{
    public string $title;
    public string $fullDescription;
    public string $short_description;
    public $date;
    public string $imageURL;
    public string $link;

    
    private function buildShortDesc(string $fullDescription){
        $possibleEndTag = ["</p>", "</ol>", "</ul>"];
        foreach($possibleEndTag as $tag){
            $tagPosition = stripos($fullDescription,$tag);
            if(!$tagPosition){
                 $tagPosition= 150;
            }
        }
        $shortDesc = substr($fullDescription, 0,  strpos($fullDescription, $tagPosition) ) ;
        return $shortDesc; 
    }
    
    public function __construct(object $item, $imageURL){
        $this->title =  $item->title;
        $this->fullDescription = $item->description ;
        $this->short_description = $this->buildShortDesc($this->fullDescription) ;
        $this->date = date('d/m/Y',strtotime( $item->pubDate));
        $this->imageURL =  empty( $imageURL) ? "https://source.unsplash.com/7XRs2HIWLWI/300x200" : $imageURL ; 
        $this->link = $item->link;
    }
    public function display(){
        print("
        <article>
            <hgroup>
                <h3> $this->title </h3>
                <h5> $this->date </h5>
            </hgroup>
            <div class='grid'>
                <img src='$this->imageURL' height='300' width='200'>
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