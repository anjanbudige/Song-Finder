<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Song Finder - Developed By Anjan</title>
  <meta property='og:image' content='https://i.ibb.co/99fXHph/717234-1.jpg
'/>
  <meta name="description" content="All In One Song Finder">
  <meta name="author" content="Nyctophile">
  <meta name="keywords" content="Music player, All Songs Player">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
<link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.8.2/css/all.min.css'>
<link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Rubik:300,400,500,700&amp;display=swap'>
<link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/mediaelement/4.2.11/mediaelementplayer.min.css'>
<link rel="stylesheet" href="style.css">

</head>
<body>

<?php 

$b='blue';
$c='green';
$e='violet';
$f='cyan';
$h='magnetica';
$i='#11998E';
$j='#EA8D8D';
$k='#D8B5FF';
$l='#FF61D2';
$m='#4E65FF';
$o='#868F96';
$p='#09203F';
$q='#764BA2';
$r='#2E3192';
$char="bcefhijklmopqr";
$clr=substr(str_shuffle($char), 0, 1);
$color=$$clr;



if(isset($_GET['song']))
{
$song_name = urlencode($_GET['song']);
$url = "https://saavn.me/search/songs?query=$song_name";
$ch = curl_init();   
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);   
curl_setopt($ch, CURLOPT_URL, $url);   
$res = curl_exec($ch);
 $decod = json_decode($res, true);
 $ldat = $decod['data'];
 $total = $ldat['total'];
 if($total!=0){
 $sng = $ldat['results'];
 $name = $sng['0']['name'];
 $id = $sng['0']['id'];
 $image = $sng['0']['image']['2']['link'];
 $duration = $sng['0']['duration'];

 if(strpos($name, "'") !== False){
  $name = str_replace("'"," ",$name);
 }

 function convert($iSeconds)
{
$min = intval($iSeconds / 60);
return $min . ':' . str_pad(($iSeconds % 60), 2, '0', STR_PAD_LEFT);
}

 $i=0;
 foreach  ($sng['0']['downloadUrl'] as $list) {
    $i++;
 }
 $i--;
    $final = $sng['0']['downloadUrl'][$i]["link"];
 $album_id = $sng['0']['album']['id'];
 $album_name = $sng['0']['album']['name'];

/*
 echo $name.' - '.$album_name.'<br>' ;
 echo $image.'<br>';
 echo $final.'<br>';
 echo $album_name.'<br>';
 */
 }

}
?>

<div class="main">
    <h2 class="title">Song Finder</h2>
    <form class="form" action="" method="get">
    <center><label style="font-family: poppins; font-size: 1.1rem; font-weight:bold;">Search Your Song: </label>
        <br><br><input type="text" name="song" placeholder="Enter Song Name" required>
        <br><input type="submit" style="font-size:15px; padding: 10px; background-color: blue; color: white; border-radius: 5px; font-family:poppins;" > </center>
    </form>

    <?php 
    $a = ["Telugu", "Hindi", "Marathi", "English", "Tamil"];
    $b = ["telugu", "hindi", "marathi", "english", "tamil"];
    if(isset($_GET['lang'])){
      $lang = $_GET['lang'];
    }
    else{
      $lang = 'telugu';
    }
    $k=0;
    ?>

    <form action="" method="get">
      <select name="lang" class="sel" onchange='if(this.value != 0) { this.form.submit(); }'>
        <option value="<?php echo $lang; ?>"><?php echo ucfirst($lang); ?></option>
        <?php foreach ($a as $a):
          ?>
          <?php if(ucfirst($lang)!=$a):?>
          <option value="<?php echo $b[$k]; $k++;?>"><?php echo $a;?></option>
          <?php else:
          $k++;
          ?>
          <?php endif;?>
          <?php endforeach;?>
      </select>

    </form>
    
    <?php if(isset($_GET['song'])): ?>
      <?php if($total!=0):?>
    <center>
<div id="root"></div>
    </center>

<br>

<?php else: ?>
<br><h2 style="color: white;"> No Song Found </h2><br>
<?php endif; ?>
<?php endif; ?>

<?php if(isset($_GET['playlist'])): ?>
  
    <center>
<div id="root"></div>
    </center>

<br>

<?php endif; ?>
<br>

<div class="dbox">
        <h2 style="color: <?php echo $color;?>;" id="dev"><!--- Don't Act Smart To Change This ---></h2>
    </div>
    <br>


    <div class="box2">
      <br>
  <h2 style="color:blue; width:100%; font-size: 1.5rem; margin-top: 10px;"><u>Trending</u></h2>
      <?php
      $url2 = "https://saavn.me/modules?songs&language=$lang";
      $ch = curl_init();
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
      curl_setopt($ch, CURLOPT_URL, $url2);
      $res = curl_exec($ch);
      $dec = json_decode($res, true);
      $data = $dec['data'];
      $trend = $data['trending'];
      $songs = $trend['songs'];
      $albums = $data['albums'];
      $charts = $data['charts'];
      $playlists = $data['playlists'];
      ?>
      
      
      
      <?php foreach($playlists as $p):?>
        <div class="new">
        <a href="<?php echo "?playlist=".$p['id'];?>" style="text-decoration: none;" >
          <img style="width: 150px; height: 150px;" src="<?php echo $p['image']['2']['link'];?>" alt="<?php echo $p['title'];?>">
          <br>
          <h3 style="font-family: solway; font-size: 1.1rem; color:purple;">
            <?php echo $p['title'];?>
          </h3></a>
          <br>

          </div>
          
        <?php endforeach;?>


      <br>
    </div>
     <br>
   
            

    <div class="box">
      <br>
      <h2><u>Quote of the day</u></h2>
      <br>

    <?php  
  $quotes[] = 'I want someone who will look at me the same way I look at chocolate cake.';
  $quotes[] = 'You want to know who I’m in love with? Read the first word again.';
  $quotes[] = 'Life is the first gift, love is the second, and understanding the third.';
  $quotes[] = 'Love is an emotion experienced by the many and enjoyed by the few.';
  $quotes[] = 'Do what you love, and you will find the way to get it out to the world.';

  srand ((double) microtime() * 1000000);
  $random_number = rand(0,count($quotes)-1);

  echo '<b style="font-family: solway;">'.($quotes[$random_number]).'</b>';
?>
<br> <br>

    </div>
    <br>
    
    
</div>

<script src='https://cdnjs.cloudflare.com/ajax/libs/react/16.8.6/umd/react.production.min.js'></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/react-dom/16.8.6/umd/react-dom.production.min.js'></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/react-router/5.0.1/react-router.min.js'></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/mediaelement/4.2.11/mediaelement-and-player.min.js'></script>

<script src="script.js" type="text/javascript"> </script>

<?php if(isset($_GET['song'])): ?>

  <?php if($total!=0):?>
  <?php 
$url = "https://saavn.me/albums?id=$album_id";
//$url = "https://www.jiosaavn.com/api.php?p=1&q=Telugu&_format=json&_marker=0&api_version=4&ctx=web6dot0&n=40&__call=search.getResults";
$ch = curl_init();   
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);   
curl_setopt($ch, CURLOPT_URL, $url);   
$res = curl_exec($ch);   
$tren = json_decode($res, true);
$trend = $tren['data']['songs'];
$j = 0;
?>

  <script>

function _defineProperty(obj, key, value) {if (key in obj) {Object.defineProperty(obj, key, { value: value, enumerable: true, configurable: true, writable: true });} else {obj[key] = value;}return obj;}
class CardProfile extends React.Component {constructor(...args) {super(...args);_defineProperty(this, "state",
    {
      index: 0,
      currentTime: '0:00',
      musicList: [{ name: '<?php echo $name;?>', author: '<?php echo $album_name; ?>', img: '<?php echo $image;?>', audio: '<?php echo $final;?>', duration: '<?php echo convert($duration);?>' },
      <?php foreach($trend as $tr): ?>
        <?php if($tr['id']!=$id): ?>
        { name: '<?php echo $tr['name']; ?>', author: '<?php echo $tren['data']['name'];?>', img: '<?php echo $tr['image']['2']['link']; ?>', audio: '<?php foreach($tr['downloadUrl'] as $durl){
          $j++;
          } 
          $j--;
          echo  $tr['downloadUrl'][$j]["link"];
          $j=0;
          
          ?>', duration: '<?php $dur = $tr['duration'];
          echo convert($dur);?>' },
      <?php endif;?>
        <?php endforeach; ?>
    ],
      pause: false });_defineProperty(this, "changeCurrentTime",



















    e => {
      const duration = this.playerRef.duration;

      const playheadWidth = this.timelineRef.offsetWidth;
      const offsetWidht = this.timelineRef.offsetLeft;
      const userClickWidht = e.clientX - offsetWidht;

      const userClickWidhtInPercent = userClickWidht * 100 / playheadWidth;

      this.playheadRef.style.width = userClickWidhtInPercent + "%";
      this.playerRef.currentTime = duration * userClickWidhtInPercent / 100;
    });_defineProperty(this, "hoverTimeLine",

    e => {
      const duration = this.playerRef.duration;

      const playheadWidth = this.timelineRef.offsetWidth;

      const offsetWidht = this.timelineRef.offsetLeft;
      const userClickWidht = e.clientX - offsetWidht;
      const userClickWidhtInPercent = userClickWidht * 100 / playheadWidth;

      if (userClickWidhtInPercent <= 100) {
        this.hoverPlayheadRef.style.width = userClickWidhtInPercent + "%";
      }

      const time = duration * userClickWidhtInPercent / 100;

      if (time >= 0 && time <= duration) {
        this.hoverPlayheadRef.dataset.content = this.formatTime(time);
      }
    });_defineProperty(this, "resetTimeLine",

    () => {
      this.hoverPlayheadRef.style.width = 0;
    });_defineProperty(this, "timeUpdate",

    () => {
      const duration = this.playerRef.duration;
      const timelineWidth = this.timelineRef.offsetWidth - this.playheadRef.offsetWidth;
      const playPercent = 100 * (this.playerRef.currentTime / duration);
      this.playheadRef.style.width = playPercent + "%";
      const currentTime = this.formatTime(parseInt(this.playerRef.currentTime));
      this.setState({
        currentTime });

    });_defineProperty(this, "formatTime",

    currentTime => {
      const minutes = Math.floor(currentTime / 60);
      let seconds = Math.floor(currentTime % 60);

      seconds = seconds >= 10 ? seconds : "0" + seconds % 60;

      const formatTime = minutes + ":" + seconds;

      return formatTime;
    });_defineProperty(this, "updatePlayer",

    () => {
      const { musicList, index } = this.state;
      const currentSong = musicList[index];
      const audio = new Audio(currentSong.audio);
      this.playerRef.load();
    });_defineProperty(this, "nextSong",

    () => {
      const { musicList, index, pause } = this.state;

      this.setState({
        index: (index + 1) % musicList.length });

      this.updatePlayer();
      if (pause) {
        this.playerRef.play();
      }
    });_defineProperty(this, "prevSong",

    () => {
      const { musicList, index, pause } = this.state;

      this.setState({
        index: (index + musicList.length - 1) % musicList.length });

      this.updatePlayer();
      if (pause) {
        this.playerRef.play();
      }
    });_defineProperty(this, "playOrPause",


    () => {
      const { musicList, index, pause } = this.state;
      const currentSong = musicList[index];
      const audio = new Audio(currentSong.audio);
      if (!this.state.pause) {
        this.playerRef.play();
      } else {
        this.playerRef.pause();
      }
      this.setState({
        pause: !pause });

    });_defineProperty(this, "clickAudio",

    key => {
      const { pause } = this.state;

      this.setState({
        index: key });


      this.updatePlayer();
      if (pause) {
        this.playerRef.play();
      }
    });}componentDidMount() {this.playerRef.addEventListener("timeupdate", this.timeUpdate, false);this.playerRef.addEventListener("ended", this.nextSong, false);this.timelineRef.addEventListener("click", this.changeCurrentTime, false);this.timelineRef.addEventListener("mousemove", this.hoverTimeLine, false);this.timelineRef.addEventListener("mouseout", this.resetTimeLine, false);}componentWillUnmount() {this.playerRef.removeEventListener("timeupdate", this.timeUpdate);this.playerRef.removeEventListener("ended", this.nextSong);this.timelineRef.removeEventListener("click", this.changeCurrentTime);this.timelineRef.removeEventListener("mousemove", this.hoverTimeLine);this.timelineRef.removeEventListener("mouseout", this.resetTimeLine);}


  render() {
    const { musicList, index, currentTime, pause } = this.state;
    const currentSong = musicList[index];
    return /*#__PURE__*/(
      React.createElement("div", { className: "card" }, /*#__PURE__*/
      React.createElement("div", { className: "current-song" }, /*#__PURE__*/
      React.createElement("audio", { ref: ref => this.playerRef = ref }, /*#__PURE__*/
      React.createElement("source", { src: currentSong.audio, type: "audio/ogg" }), "Your browser does not support the audio element."), /*#__PURE__*/


      React.createElement("div", { className: "img-wrap" }, /*#__PURE__*/
      React.createElement("img", { src: currentSong.img })), /*#__PURE__*/

      React.createElement("span", { className: "song-name" }, currentSong.name), /*#__PURE__*/
      React.createElement("span", { className: "song-autor" }, currentSong.author), /*#__PURE__*/

      React.createElement("div", { className: "time" }, /*#__PURE__*/
      React.createElement("div", { className: "current-time" }, currentTime), /*#__PURE__*/
      React.createElement("div", { className: "end-time" }, currentSong.duration)), /*#__PURE__*/


      React.createElement("div", { ref: ref => this.timelineRef = ref, id: "timeline" }, /*#__PURE__*/
      React.createElement("div", { ref: ref => this.playheadRef = ref, id: "playhead" }), /*#__PURE__*/
      React.createElement("div", { ref: ref => this.hoverPlayheadRef = ref, class: "hover-playhead", "data-content": "0:00" })), /*#__PURE__*/


      React.createElement("div", { className: "controls" }, /*#__PURE__*/
      React.createElement("button", { onClick: this.prevSong, className: "prev prev-next current-btn" }, /*#__PURE__*/React.createElement("i", { className: "fas fa-backward" })), /*#__PURE__*/

      React.createElement("button", { onClick: this.playOrPause, className: "play current-btn" },

      !pause ? /*#__PURE__*/React.createElement("i", { className: "fas fa-play" }) : /*#__PURE__*/
      React.createElement("i", { class: "fas fa-pause" })), /*#__PURE__*/


      React.createElement("button", { onClick: this.nextSong, className: "next prev-next current-btn" }, /*#__PURE__*/React.createElement("i", { className: "fas fa-forward" })))), /*#__PURE__*/



      React.createElement("div", { className: "play-list" },
      musicList.map((music, key = 0) => /*#__PURE__*/
      React.createElement("div", { key: key,
        onClick: () => this.clickAudio(key),
        className: "track " + (
        index === key && !pause ? 'current-audio' : '') + (
        index === key && pause ? 'play-now' : '') }, /*#__PURE__*/

      React.createElement("img", { className: "track-img", src: music.img }), /*#__PURE__*/
      React.createElement("div", { className: "track-discr" }, /*#__PURE__*/
      React.createElement("span", { className: "track-name" }, music.name), /*#__PURE__*/
      React.createElement("span", { className: "track-author" }, music.author)), /*#__PURE__*/

      React.createElement("span", { className: "track-duration" },
      index === key ?
      currentTime :
      music.duration))))));







  }}


ReactDOM.render( /*#__PURE__*/
React.createElement(CardProfile, null),
document.getElementById('root'));
</script>

<?php endif;?>
<?php endif;?>

<?php if(isset($_GET['playlist'])):?>

  <?php 
  $playlist = $_GET['playlist'];
  $url3 = "https://saavn.me/playlists?id=$playlist";
  $ch = curl_init();
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
  curl_setopt($ch, CURLOPT_URL, $url3);
  $res = curl_exec($ch);
  $data = json_decode($res, true);
  $trend = $data['data']['songs'];
  $j=0;

  function convert($iSeconds)
  {
  $min = intval($iSeconds / 60);
  return $min . ':' . str_pad(($iSeconds % 60), 2, '0', STR_PAD_LEFT);
  }

  ?>

  <script>

  function _defineProperty(obj, key, value) {if (key in obj) {Object.defineProperty(obj, key, { value: value, enumerable: true, configurable: true, writable: true });} else {obj[key] = value;}return obj;}
  class CardProfile extends React.Component {constructor(...args) {super(...args);_defineProperty(this, "state",
      {
        index: 0,
        currentTime: '0:00',
        musicList: [<?php foreach($trend as $tr): ?>
          { name: '<?php echo $tr['name']; ?>', author: '<?php echo $tr['album']['name'];?>', img: '<?php echo $tr['image']['2']['link']; ?>', audio: '<?php foreach($tr['downloadUrl'] as $durl){
            $j++;
            } 
            $j--;
            echo  $tr['downloadUrl'][$j]["link"];
            $j=0;
            
            ?>', duration: '<?php $dur = $tr['duration'];
            echo convert($dur);?>' },
          <?php endforeach; ?>
      ],
        pause: false });_defineProperty(this, "changeCurrentTime",
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
      e => {
        const duration = this.playerRef.duration;
  
        const playheadWidth = this.timelineRef.offsetWidth;
        const offsetWidht = this.timelineRef.offsetLeft;
        const userClickWidht = e.clientX - offsetWidht;
  
        const userClickWidhtInPercent = userClickWidht * 100 / playheadWidth;
  
        this.playheadRef.style.width = userClickWidhtInPercent + "%";
        this.playerRef.currentTime = duration * userClickWidhtInPercent / 100;
      });_defineProperty(this, "hoverTimeLine",
  
      e => {
        const duration = this.playerRef.duration;
  
        const playheadWidth = this.timelineRef.offsetWidth;
  
        const offsetWidht = this.timelineRef.offsetLeft;
        const userClickWidht = e.clientX - offsetWidht;
        const userClickWidhtInPercent = userClickWidht * 100 / playheadWidth;
  
        if (userClickWidhtInPercent <= 100) {
          this.hoverPlayheadRef.style.width = userClickWidhtInPercent + "%";
        }
  
        const time = duration * userClickWidhtInPercent / 100;
  
        if (time >= 0 && time <= duration) {
          this.hoverPlayheadRef.dataset.content = this.formatTime(time);
        }
      });_defineProperty(this, "resetTimeLine",
  
      () => {
        this.hoverPlayheadRef.style.width = 0;
      });_defineProperty(this, "timeUpdate",
  
      () => {
        const duration = this.playerRef.duration;
        const timelineWidth = this.timelineRef.offsetWidth - this.playheadRef.offsetWidth;
        const playPercent = 100 * (this.playerRef.currentTime / duration);
        this.playheadRef.style.width = playPercent + "%";
        const currentTime = this.formatTime(parseInt(this.playerRef.currentTime));
        this.setState({
          currentTime });
  
      });_defineProperty(this, "formatTime",
  
      currentTime => {
        const minutes = Math.floor(currentTime / 60);
        let seconds = Math.floor(currentTime % 60);
  
        seconds = seconds >= 10 ? seconds : "0" + seconds % 60;
  
        const formatTime = minutes + ":" + seconds;
  
        return formatTime;
      });_defineProperty(this, "updatePlayer",
  
      () => {
        const { musicList, index } = this.state;
        const currentSong = musicList[index];
        const audio = new Audio(currentSong.audio);
        this.playerRef.load();
      });_defineProperty(this, "nextSong",
  
      () => {
        const { musicList, index, pause } = this.state;
  
        this.setState({
          index: (index + 1) % musicList.length });
  
        this.updatePlayer();
        if (pause) {
          this.playerRef.play();
        }
      });_defineProperty(this, "prevSong",
  
      () => {
        const { musicList, index, pause } = this.state;
  
        this.setState({
          index: (index + musicList.length - 1) % musicList.length });
  
        this.updatePlayer();
        if (pause) {
          this.playerRef.play();
        }
      });_defineProperty(this, "playOrPause",
  
  
      () => {
        const { musicList, index, pause } = this.state;
        const currentSong = musicList[index];
        const audio = new Audio(currentSong.audio);
        if (!this.state.pause) {
          this.playerRef.play();
        } else {
          this.playerRef.pause();
        }
        this.setState({
          pause: !pause });
  
      });_defineProperty(this, "clickAudio",
  
      key => {
        const { pause } = this.state;
  
        this.setState({
          index: key });
  
  
        this.updatePlayer();
        if (pause) {
          this.playerRef.play();
        }
      });}componentDidMount() {this.playerRef.addEventListener("timeupdate", this.timeUpdate, false);this.playerRef.addEventListener("ended", this.nextSong, false);this.timelineRef.addEventListener("click", this.changeCurrentTime, false);this.timelineRef.addEventListener("mousemove", this.hoverTimeLine, false);this.timelineRef.addEventListener("mouseout", this.resetTimeLine, false);}componentWillUnmount() {this.playerRef.removeEventListener("timeupdate", this.timeUpdate);this.playerRef.removeEventListener("ended", this.nextSong);this.timelineRef.removeEventListener("click", this.changeCurrentTime);this.timelineRef.removeEventListener("mousemove", this.hoverTimeLine);this.timelineRef.removeEventListener("mouseout", this.resetTimeLine);}
  
  
    render() {
      const { musicList, index, currentTime, pause } = this.state;
      const currentSong = musicList[index];
      return /*#__PURE__*/(
        React.createElement("div", { className: "card" }, /*#__PURE__*/
        React.createElement("div", { className: "current-song" }, /*#__PURE__*/
        React.createElement("audio", { ref: ref => this.playerRef = ref }, /*#__PURE__*/
        React.createElement("source", { src: currentSong.audio, type: "audio/ogg", autoPlay: "autoplay"}), "Your browser does not support the audio element."), /*#__PURE__*/
  
  
        React.createElement("div", { className: "img-wrap" }, /*#__PURE__*/
        React.createElement("img", { src: currentSong.img })), /*#__PURE__*/
  
        React.createElement("span", { className: "song-name" }, currentSong.name), /*#__PURE__*/
        React.createElement("span", { className: "song-autor" }, currentSong.author), /*#__PURE__*/
  
        React.createElement("div", { className: "time" }, /*#__PURE__*/
        React.createElement("div", { className: "current-time" }, currentTime), /*#__PURE__*/
        React.createElement("div", { className: "end-time" }, currentSong.duration)), /*#__PURE__*/
  
  
        React.createElement("div", { ref: ref => this.timelineRef = ref, id: "timeline" }, /*#__PURE__*/
        React.createElement("div", { ref: ref => this.playheadRef = ref, id: "playhead" }), /*#__PURE__*/
        React.createElement("div", { ref: ref => this.hoverPlayheadRef = ref, class: "hover-playhead", "data-content": "0:00" })), /*#__PURE__*/
  
  
        React.createElement("div", { className: "controls" }, /*#__PURE__*/
        React.createElement("button", { onClick: this.prevSong, className: "prev prev-next current-btn" }, /*#__PURE__*/React.createElement("i", { className: "fas fa-backward" })), /*#__PURE__*/
  
        React.createElement("button", { onClick: this.playOrPause, className: "play current-btn" },
  
        !pause ? /*#__PURE__*/React.createElement("i", { className: "fas fa-play" }) : /*#__PURE__*/
        React.createElement("i", { class: "fas fa-pause" })), /*#__PURE__*/
  
  
        React.createElement("button", { onClick: this.nextSong, className: "next prev-next current-btn" }, /*#__PURE__*/React.createElement("i", { className: "fas fa-forward" })))), /*#__PURE__*/
  
  
  
        React.createElement("div", { className: "play-list" },
        musicList.map((music, key = 0) => /*#__PURE__*/
        React.createElement("div", { key: key,
          onClick: () => this.clickAudio(key),
          className: "track " + (
          index === key && !pause ? 'current-audio' : '') + (
          index === key && pause ? 'play-now' : '') }, /*#__PURE__*/
  
        React.createElement("img", { className: "track-img", src: music.img }), /*#__PURE__*/
        React.createElement("div", { className: "track-discr" }, /*#__PURE__*/
        React.createElement("span", { className: "track-name" }, music.name), /*#__PURE__*/
        React.createElement("span", { className: "track-author" }, music.author)), /*#__PURE__*/
  
        React.createElement("span", { className: "track-duration" },
        index === key ?
        currentTime :
        music.duration))))));
  
  
  
  
  
  
  
    }}
  
  
  ReactDOM.render( /*#__PURE__*/
  React.createElement(CardProfile, null),
  document.getElementById('root'));
  </script>

<?php endif;?>

</body>
</html>