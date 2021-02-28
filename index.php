<?php
ob_start();
define("API_KEY","1624075138:AAG8wJyzoBzGg0AWADhH3kPNJywABldkqvM");
$admin = "1445618593";
$tgkanal = "turikanal"; 
$adminuser = "bako404";
$zayafkachi = "1445618593";
$admin2 = "1445618593";
$botname = "pulrubl_bot";
echo "👨‍�? Dasturchi: t.me/bako404";

function addstat($id){
    $check = file_get_contents("Bek_Koder.bot");
    $rd = explode("\n",$check);
    if(!in_array($id,$rd)){
        file_put_contents("Bek_Koder.bot","\n".$id,FILE_APPEND);
    }
}

function banstat($id){
    $check = file_get_contents("Bek_Koder.ban");
    $rd = explode("\n",$check);
    if(!in_array($id,$rd)){
        file_put_contents("Bek_Koder.ban","\n".$id,FILE_APPEND);
    }
}

function step($id,$value){
file_put_contents("Bek_Koder/$id.step","$value");
}

function stepbot($id,$value){
file_put_contents("Bek_Koderbot/$id.step","$value");
}

function typing($chatid){ 
return bot("sendChatAction",[
"chat_id"=>$chatid,
"action"=>"typing",
]);
}

function joinchat($id){
     global $message_id,$referalsum,$firstname;
     $ret = bot("getChatMember",[
         "chat_id"=>"-1001410720708", //kanal
         "user_id"=>$id,
         ]);
$stat = $ret->result->status;
         if($stat=="creator" or $stat=="administrator" or $stat=="member"){
      return true;
         }else{
     bot("sendMessage",[
         "chat_id"=>$id,
         "text"=>"Подпишитесь на наши каналы ниже. Вы можете полностью использовать бот позже!
Если вы хотите зарабатывать денги, вы должна подписаться наш 2 канал�?",
         "reply_to_message_id"=>$message_id,
"disable_web_page_preview"=>true,
"reply_markup"=>json_encode([
"inline_keyboard"=>[
[["text"=>"♨️ YouTube подписаться �?","url"=>"https://www.youtube.com/channel/UC9_-zA2NoIeXcpEQxDNKqJQ"],],
[["text"=>"�? подписаться �?","url"=>"https://t.me/qaygudaman_hijron_taskinim"],],
[["text"=>"�? Я подтверждаю �?","callback_data"=>"result"],],
]
]),
]);  
sleep(2);
     if(file_exists("Bek_Koder/$id.referalid")){
           $file =  file_get_contents("Bek_Koder/$id.referalid");
           $get =  file_get_contents("Bek_Koder/$id.channel");
           if($get=="true"){
            file_put_contents("Bek_Koder/$id.channel","failed");
            $user = file_get_contents("Bek_Koder/$file.pul");
            $user = $user - $referalsum;
            file_put_contents("Bek_Koder/$file.pul","$user");
             bot("sendMessage",[
             "chat_id"=>$file,
             "text"=>"Вы оштрафованы на $referalsum руб за вашего [друга](tg://user?id=$id),покинувшего наши каналы.",
             "parse_mode"=>"markdown",
             "reply_markup"=>$menu,
             ]);
           }
         }  
return false;
}
}

function reyting(){
    $text = "🏆 TOP 20 🔝\n🏦 богатые\n\n";
    $daten = [];
    $rev = [];
    $fayllar = glob("./Bek_Koder/*.*");
    foreach($fayllar as $file){
        if(mb_stripos($file,".pul")!==false){
        $value = file_get_contents($file);
        $id = str_replace(["./Bek_Koder/",".pul"],["",""],$file);
        $daten[$value] = $id;
        $rev[$id] = $value;
        }
        echo $file;
    }

    asort($rev);
    $reversed = array_reverse($rev);
    for($i=0;$i<20;$i+=1){
        $order = $i+1;
        $id = $daten["$reversed[$i]"];
        $text.= "<b>{$order}</b>. <a href='tg://user?id={$id}'>{$id}</a> - "."<code>".$reversed[$i]."</code>"." <b>руб</b>"."\n";
    }
    return $text;
}


function bot($method,$datas=[]){
    $url = "https://api.telegram.org/bot".API_KEY."/".$method;
    $ch = curl_init();
    curl_setopt($ch,CURLOPT_URL,$url);
    curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
    curl_setopt($ch,CURLOPT_POSTFIELDS,$datas);
    $res = curl_exec($ch);
    if(curl_error($ch)){
        var_dump(curl_error($ch));
    }else{
        return json_decode($res);
    }
}

$update = json_decode(file_get_contents('php://input'));
$message = $update->message;
$callbackdata = $update->callback_query->data;
$chatid = $message->chat->id;
$chat_id = $update->callback_query->message->chat->id;
$messageid = $message->message_id;
$id = $update->callback_query->id;
$fromid = $message->from->id;
$from_id = $update->callback_query->from->id;
$firstname = $message->from->first_name;
$first_name = $update->callback_query->from->first_name;
$lastname = $message->from->last_name;
$message_id = $update->callback_query->message->message_id;
$text = $message->text;
$contact = $message->contact;
$contactid = $contact->user_id;
$contactuser = $contact->username;
$contactname = $contact->first_name;
$phonenumber = $contact->phone_number;
$messagereply = $message->reply_to_message->message_id;
$user = $message->from->username;
$userid = $update->callback_query->from->username;
$query = $update->inline_query->query;
$inlineid = $update->inline_query->from->id;
$messagereply = $message->reply_to_message->message_id;
$resultid = file_get_contents("Bek_Koder.bot");
$ban = file_get_contents("Bek_Koder/$chatid.ban");
$banid = file_get_contents("Bek_Koder/$chat_id.ban");
$sabab = file_get_contents("Bek_Koder/$chat_id.sabab");
$minimalsumma = file_get_contents("Bek_Koder/minimal.sum");
$sum = file_get_contents("Bek_Koder/$chatid.pul");
$sumid = file_get_contents("Bek_Koder/$chat_id.pul");
$jami = file_get_contents("Bek_Koder/summa.text");
$referal = file_get_contents("Bek_Koder/$chatid.referal");
$referalcallback = file_get_contents("Bek_Koder/$chat_id.referal");
$click = file_get_contents("Bek_Koder/$chatid.karta");
$paynet = file_get_contents("Bek_Koder/$chatid.paynet");
$click = file_get_contents("Bek_Koder/$chatid.click");
$referalsum = file_get_contents("Bek_Koder/referal.sum");
if(file_get_contents("Bek_Koder/minimal.sum")){
}else{    file_put_contents("Bek_Koder/minimal.sum","50");
}
if(file_get_contents("Bek_Koder/$chatid.referal")){
}else{    file_put_contents("Bek_Koder/$chatid.referal","0");
}
if(file_get_contents("Bek_Koder/$chat_id.referal")){
}else{    file_put_contents("Bek_Koder/$chat_id.referal","0");
}
if(file_get_contents("Bek_Koder/summa.text")){
}else{    file_put_contents("Bek_Koder/summa.text","0");
}
if(file_get_contents("Bek_Koder/referal.sum")){
}else{    file_put_contents("Bek_Koder/referal.sum","0");
}
if(file_get_contents("Bek_Koder/$chatid.pul")){
}else{    file_put_contents("Bek_Koder/$chatid.pul","0");
}
if(file_get_contents("Bek_Koder/$chat_id.pul")){
}else{    file_put_contents("Bek_Koder/$chat_id.pul","0");
}
$step = file_get_contents("Bek_Koder/$chatid.step");
$step = file_get_contents("Bek_Koderbot/$chatid.step");
mkdir("Bek_Koder");
mkdir("Bek_Koderbot");
if(!is_dir("Bek_Koder")){
  mkdir("Bek_Koder");
}

$menu = json_encode([
"resize_keyboard"=>true,
    "keyboard"=>[
[["text"=>"Заработать 🚀"],["text"=>"Мой кабинет 💳"],],
[["text"=>"🚫 Важно"],["text"=>"📊 Отчет"],],
]
]);

$panel = json_encode([
"resize_keyboard"=>true,
    "keyboard"=>[
[["text"=>"🗣 Userlarga xabar yuborish"],],
[["text"=>"💳 Hisob tekshirish"],["text"=>"💰 Hisob toʻldirish"],],
[["text"=>"👥 Referal narxini o'zgartirish"],],
[["text"=>"�? Bandan olish"],["text"=>"🚫 Ban berish"],],
[["text"=>"📤 Minimal rubl yechish"],],
[["text"=>"🔙 Назад"],],
]
]);

$back = json_encode([
 "one_time_keyboard"=>true,
"resize_keyboard"=>true,
    "keyboard"=>[
[["text"=>"🔙 Назад"],],
]
]);

if((($text=="/admin") and ($chatid==$admin or $chatid==$admin2))){
typing($chatid);
bot('sendMessage',[
"chat_id"=>$chatid,
"text"=>"<b>Salom, Siz bot administratorisiz. Kerakli boʻlimni tanlang:</b>",
"parse_mode"=>"html",
"reply_markup"=>$panel,
]);
}

if((($text=="🗣 Userlarga xabar yuborish") and ($chatid==$admin or $chatid==$admin2))){
typing($chatid);
stepbot($chatid,"send_post");
      bot("sendMessage",[
      "chat_id"=>$chatid,
      "text"=>"<b>Rasmli xabar matnini kiriting. Xabar turi markdown:</b>",
      "parse_mode"=>"html",
          "reply_markup"=>$panel,
          ]);
            }

     if((($step=="send_post") and ($chatid==$admin or $chatid==$admin2))){
        $file_id = $message->photo[0]->file_id;
        $caption = $message->caption;
                $ok = bot("sendPhoto",[
                  "chat_id"=>$chatid,
                  "photo"=>$file_id,
                  "caption"=>$caption,
                  "parse_mode"=>"markdown",
                ]);
                if($ok->ok){
                  bot("sendPhoto",[
                    "chat_id"=>$chatid,
                    "photo"=>$file_id,
                      "caption"=>"$caption

Yaxshi, rasmni qabul qildim!
Endi tugmani na‘muna bo'yicha joylang.
<pre>[👨‍�? Dasturchi+https://t.me/Bek_Koder]
[Yangiliklar+https://t.me/qaygudaman_hijron_taskinim]</pre>",
"parse_mode"=>"html",
                      "disable_web_page_preview"=>true,
                    ]);
             file_put_contents("Bek_Koderbot/$chatid.text","$file_id{set}$caption");
             stepbot($chatid,"xabar_tugma");
         }
     }
     
    if((($step=="xabar_tugma") and ($chatid==$admin or $chatid==$admin2))){
      $xabar = bot("sendMessage",[
        "chat_id"=>$chatid,
        "text"=>"Connections...",
      ])->result->message_id;
      bot("deleteMessage",[
        "chat_id"=>$chat_id,
        "message_id"=>$xabar,
      ]);
   $usertext = file_get_contents("Bek_Koderbot/$chatid.text");
   $fileid = explode("{set}",$usertext);
   $file_id = $fileid[0];
   $caption = $fileid[1];
       preg_match_all("|\[(.*)\]|U",$text,$ouvt);
$keyboard = [];
foreach($ouvt[1] as $ouut){
$ot = explode("+",$ouut);
array_push($keyboard,[["url"=>"$ot[1]", "text"=>"$ot[0]"],]);
}
$ok = bot("sendPhoto",[
"chat_id"=>$chatid,
"photo"=>$file_id,
"caption"=>"Sizning rasmingiz ko‘rinishi:\n\n".$caption,
"parse_mode"=>"html",
"reply_markup"=>json_encode(
["inline_keyboard"=>
$keyboard
]),
]);
if($ok->ok){
$userlar = file_get_contents("Bek_Koder.bot");
$count = substr_count($userlar,"\n");
$count_member = count(file("Bek_Koder.bot"))-1;
  $ids = explode("\n",$userlar);
  foreach ($ids as $line => $id) {
    $clear = bot("sendPhoto",[
"chat_id"=>$id,
"photo"=>$file_id,
"caption"=>$caption,
"parse_mode"=>"markdown",
"disable_web_page_preview"=>true,
"reply_markup"=>json_encode(
["inline_keyboard"=>
$keyboard
]),
]);
unlink("Bek_Koderbot/$chatid.step");
}

if($clear){
$userlar = file_get_contents("Bek_Koder.bot");
$count = substr_count($userlar,"\n");
$count_member = count(file("Bek_Koder.bot"))-1;
  bot("sendMessage",[
    "chat_id"=>$chatid,
    "text"=>"Xabar <b>$count_member</b> userlarga yuborildi!",
    "parse_mode"=>"html",
  ]);
}
}else{
  bot("sendMessage",[
    "chat_id"=>$chatid,
    "text"=>"Tugmani kiritishda xato bor. Iltimos, qaytadan yuboring:",
  ]);
unlink("Bek_Koderbot/$chatid.step");  
}
}

if((($text=="💳 Hisob tekshirish") and ($chatid==$admin or $chatid==$admin2))){
typing($chatid);
stepbot($chatid,"result");
bot("sendMessage",[
"chat_id"=>$chatid,
"text"=>"<b>Foydalanuvchini ID raqamini kiriting:</b>",
"parse_mode"=>"html",
"reply_markup"=>$panel,
]);
}

if((($step=="result") and ($chatid==$admin or $chatid==$admin2))){
typing($chatid);
if($text=="🗣 Userlarga xabar yuborish" or $text=="👥 Referal narxini o'zgartirish" or $text=="💳 Hisob tekshirish" or $text=="💰 Hisob toʻldirish" or $text=="�? Bandan olish" or $text=="🚫 Ban berish" or $text=="📤 Minimal rubl yechish" or $text=="🔙 Назад"){
}else{
$sum = file_get_contents("Bek_Koder/$text.pul");
$referal = file_get_contents("Bek_Koder/$text.referal");
$raqam = file_get_contents("Bek_Koder/$text.contact");
bot("sendMessage",[
"chat_id"=>$chatid,
"text"=>"<b>Foydalanuvchi hisobi:</b> <code>$sum</code>\n<b>Foydalanuvchi referali:</b> <code>$referal</code>\n<b>Foydalanuvchi raqami:</b> <code>$raqam</code>",
"parse_mode"=>"html",
"reply_markup"=>$panel,
]);
}
}

if((($text=="💰 Hisob toʻldirish") and ($chatid==$admin or $chatid==$admin2))){
typing($chatid);
stepbot($chatid,"coin");
bot("sendMessage",[
"chat_id"=>$chatid,
"text"=>"<b>Foydalanuvchi hisobini necha rublga toʻldirmoqchisiz:</b>",
"parse_mode"=>"html",
"reply_markup"=>$panel,
]);
}

if((($step=="coin") and ($chatid==$admin or $chatid==$admin2))){
typing($chatid);
file_put_contents("Bek_Koder/$chatid.coin",$text);
if($text=="🗣 Userlarga xabar yuborish" or $text=="👥 Referal narxini o'zgartirish" or $text=="💳 Hisob tekshirish" or $text=="💰 Hisob toʻldirish" or $text=="�? Bandan olish" or $text=="🚫 Ban berish" or $text=="📤 Minimal rubl yechish" or $text=="🔙 Назад"){
}else{
stepbot($chatid,"pay");
bot("sendMessage",[
"chat_id"=>$chatid,
"text"=>"<b>Foydalanuvchi ID raqamini kiriting:</b>",
"parse_mode"=>"html",
"reply_markup"=>$panel,
]);
}
}

if((($step=="pay") and ($chatid==$admin or $chatid==$admin2))){
typing($chatid);
if($text=="🗣 Userlarga xabar yuborish" or $text=="👥 Referal narxini o'zgartirish" or $text=="💳 Hisob tekshirish" or $text=="💰 Hisob toʻldirish" or $text=="�? Bandan olish" or $text=="🚫 Ban berish" or $text=="📤 Minimal rubl yechish" or $text=="🔙 Назад"){
}else{
$summa = file_get_contents("Bek_Koder/$chatid.coin");
$sum =  file_get_contents("Bek_Koder/$text.pul");
$jami = $sum + $summa;
file_put_contents("Bek_Koder/$text.pul","$jami");
bot("sendMessage",[
   "chat_id"=>$text,
          "text"=>"💰 Ваш счет пополнен на $summa руб!\nВаш текущий счет: $jami руб.",
]);
bot("sendMessage",[
"chat_id"=>$chatid,
"text"=>"<b>Foydalanuvchi balansi toʻldirildi!</b>",
"parse_mode"=>"html",
"reply_markup"=>$panel,
]);
unlink("Bek_Koderbot/$chatid.step");
}
}

if((($text=="👥 Referal narxini o'zgartirish") and ($chatid==$admin  or $chatid==$admin2))){
typing($chatid);
stepbot($chatid,"referal");
bot("sendMessage",[
"chat_id"=>$chatid,
"text"=>"<b>Referal narxini kiriting:</b>",
"parse_mode"=>"html",
"reply_markup"=>$panel,
]);
}

if((($step=="referal") and ($chatid==$admin  or $chatid==$admin2))){
typing($chatid);
if($text=="🗣 Userlarga xabar yuborish" or $text=="👥 Referal narxini o'zgartirish" or $text=="💳 Hisob tekshirish" or $text=="💰 Hisob toʻldirish" or $text=="�? Bandan olish" or $text=="🚫 Ban berish" or $text=="📤 Minimal rubl yechish" or $text=="🔙 Назад"){
}else{
file_put_contents("Bek_Koder/referal.sum","$text");
bot("sendMessage",[
"chat_id"=>$chatid,
"text"=>"<b>Referal taklif qilish narxi: $text ga o'zgardi!</b>",
"parse_mode"=>"html",
"reply_markup"=>$panel,
]);
unlink("Bek_Koderbot/$chatid.step");
}
}

if((($text=="�? Bandan olish") and ($chatid==$admin or $chatid==$admin2))){
stepbot($chatid,"unban");
bot("sendMessage",[
"chat_id"=>$chatid,
"text"=>"<b>Foydalanuvchini ID raqamini kiriting:</b>",
"parse_mode"=>"html",
"reply_markup"=>$panel,
]);
}

if((($step=="unban") and ($chatid==$admin or $chatid==$admin2))){
unlink("Bek_Koder/$text.ban");
if($text=="🗣 Userlarga xabar yuborish" or $text=="👥 Referal narxini o'zgartirish" or $text=="💳 Hisob tekshirish" or $text=="💰 Hisob toʻldirish" or $text=="�? Bandan olish" or $text=="🚫 Ban berish" or $text=="📤 Minimal rubl yechish" or $text=="🔙 Назад"){
}else{
bot("sendMessage",[
"chat_id"=>$chatid,
"text"=>"<a href='tg://user?id=$text'>Foydalanuvchi</a> <b>bandan olindi!</b>",
"parse_mode"=>"html",
"reply_markup"=>$panel,
]);
unlink("Bek_Koderbot/$chatid.step");
}
}

if((($text=="🚫 Ban berish") and ($chatid==$admin or $chatid==$admin2))){
bot("sendMessage",[
"chat_id"=>$chatid,
"text"=>"<b>Foydalanuvchini ID raqamini kiriting:</b>",
"parse_mode"=>"html",
"reply_markup"=>$panel,
]);
stepbot($chatid,"ban");
}

if((($step=="ban") and ($chatid==$admin or $chatid==$admin2))){
banstat($text);
file_put_contents("Bek_Koder/$text.ban","ban");
if($text=="🗣 Userlarga xabar yuborish" or $text=="👥 Referal narxini o'zgartirish" or $text=="💳 Hisob tekshirish" or $text=="💰 Hisob toʻldirish" or $text=="�? Bandan olish" or $text=="🚫 Ban berish" or $text=="📤 Minimal rubl yechish" or $text=="🔙 Назад"){
}else{
bot("sendMessage",[
"chat_id"=>$chatid,
"text"=>"<a href='tg://user?id=$text'>Foydalanuvchi</a> <b>banlandi!</b>",
"parse_mode"=>"html",
"reply_markup"=>$panel,
]);
unlink("Bek_Koderbot/$chatid.step");
bot("sendMessage",[
"chat_id"=>$text,
"text"=>"🚫 Вы заблокированы",
]);
}
}

if((($text=="📤 Minimal rubl yechish") and ($chatid==$admin or $chatid==$admin2))){
typing($chatid);
stepbot($chatid,"minimalsumma");
bot("sendMessage",[
"chat_id"=>$chatid,
"text"=>"<b>Minimal pul yechish narxini kiriting:</b>",
"parse_mode"=>"html",
"reply_markup"=>$panel,
]);
}

if((($step=="minimalsumma") and ($chatid==$admin or $chatid==$admin2))){
typing($chatid);
if($text=="🗣 Userlarga xabar yuborish" or $text=="👥 Referal narxini o'zgartirish" or $text=="💳 Hisob tekshirish" or $text=="💰 Hisob toʻldirish" or $text=="�? Bandan olish" or $text=="🚫 Ban berish" or $text=="📤 Minimal rubl yechish" or $text=="🔙 Назад"){
}else{
file_put_contents("Bek_Koder/minimal.sum","$text");
bot("sendMessage",[
"chat_id"=>$chatid,
"text"=>"<b>Minimal pul yechish narxi: $text ga o'zgardi!</b>",
"parse_mode"=>"html",
"reply_markup"=>$panel,
]);
unlink("Bek_Koderbot/$chatid.step");
}
}

if($callbackdata=="back" and $banid==false){
if((joinchat($from_id)=="true") and ($banid==false)){
bot("deleteMessage",[
"chat_id"=>$chat_id,
"message_id"=>$message_id,
]);
bot("sendMessage",[
"chat_id"=>$chat_id,
"text"=>"<b>📋 Главное меню!</b>",
"parse_mode"=>"html",
"reply_markup"=>$menu,
]);
}
}

if($text=="Заработать 🚀" and $ban==false){
if((joinchat($fromid)=="true") and ($ban==false)){
bot("sendphoto",[
    "chat_id"=>$chatid,
    "photo"=>new CURLFile("rasmlar/referal.jpg"),
    "caption"=>"🤝 Партнерская программа

◻️ За приглашение партера вы получите бонус в размере $referalsum руб

◻️ Вы пригласили: $referal человек

🔗 Ссылка для приглашения:

https://t.me/$botname?start=$chatid",
"disable_web_page_preview"=>true,
"reply_markup"=>json_encode([
"inline_keyboard"=>[
[["text"=>"🔗 Поделиться ссылкой","url"=>"https://t.me/share/url?url=Привет,%20хочешь%20заработать?%20Тогда%20тебе%20к%20нам!%20https://t.me/$botname?start=$chatid"],],
]
]),
]);
}
}

if($text=="Мой кабинет 💳" and $ban==false){
if((joinchat($fromid)=="true") and ($ban==false)){
bot("sendphoto",[
"chat_id"=>$chatid,
"photo"=>new CURLFile("rasmlar/balans.jpg"),
"caption"=>"🔐 Личный кабинет

👥 Партнёры: *$referal* чел
💳 Мой баланс: *$sum* руб
�? Минимальная сумма вывода средств $minimalsumma руб.",
"parse_mode"=>"markdown",
"reply_markup"=>json_encode([
"inline_keyboard"=>[
[["text"=>"🔻 Вывод","callback_data"=>"vivod"],],
]
]),
]);
}
}

if($text=="🔙 Назад" and $ban==false){
if((joinchat($fromid)=="true") and ($ban==false)){
addstat($chatid);
bot("sendMessage",[
"chat_id"=>$chatid,
"text"=>"*📋 Главное меню!*",
"parse_mode"=>"markdown",
"reply_markup"=>$menu,
]);
unlink("Bek_Koder/$chatid.step");
unlink("Bek_Koderbot/$chatid.step");
}
}

if((stripos($text,"/start")!==false) && ($ban==false)){
if((joinchat($fromid)=="true") and ($ban==false)){
addstat($fromid);
bot("sendMessage",[
"chat_id"=>$fromid,
"text"=>"*📋 Главное меню!*",
"parse_mode"=>"markdown",
"reply_markup"=>$menu,
]);
}
}

if((stripos($text,"/start")!==false) && ($ban==false)){
$public = explode("*",$text);
$refid = explode(" ",$text);
$refid = $refid[1];
if(strlen($refid)>0){
$idref = "Bek_Koder/$refid.id";
$idrefs = file_get_contents($idref);
$userlar = file_get_contents("Bek_Koder.bot");
$explode = explode("\n",$userlar);
if(!in_array($chatid,$explode)){
file_put_contents("Bek_Koder.bot","\n".$chatid,FILE_APPEND);
}
if($refid==$chatid and $ban==false){
      bot("sendMessage",[
      "chat_id"=>$chatid,
      "text"=>"📋 Главное меню!",
      "reply_to_message_id"=>$messageid,
      ]);
      }else{
    if((stripos($userlar,"$chatid")!==false) and ($ban==false)){
      bot("sendMessage",[
      "chat_id"=>$chatid,
      "text"=>"*Уважаемый пользователь!
Вы не можете быть рефералом другу, если это случится снова, вы можете быть заблокированы от бота!*",
"parse_mode"=>"markdown",
"reply_to_message_id"=>$messageid,
]);
}else{
$id = "$chatid\n";
$handle = fopen("$idref","a+");
fwrite($handle,$id);
fclose($handle);
file_put_contents("Bek_Koder/$fromid.referalid","$refid");
file_put_contents("Bek_Koder/$fromid.channel","false");
file_put_contents("Bek_Koder/$fromid.login","false");
      bot("sendMessage",[
      "chat_id"=>$refid,
"text"=>"<b>👏 Поздравляем! Вы</b> <a href='tg://user?id=$chatid'>пригласили</a> <b>своего друга в бот!
Мы не будем давать вам деньги, пока ваш друг не подпишется на наш канал!</b>",
"parse_mode"=>"html",
]);
}
}
}
}

if($callbackdata=="result" and ($banid==false)){
addstat($from_id);
if((joinchat($from_id)=="true")  and ($banid==false)){
bot("deleteMessage",[
"chat_id"=>$from_id,
"message_id"=>$message_id,
]);
$reply = bot("sendMessage",[
"chat_id"=>$from_id,
"text"=>"<b>Ваша реферальная ссылка👇</b>",
"parse_mode"=>"html",
"reply_markup"=>$menu,
])->result->message_id;
bot("sendmessage",[
    "chat_id"=>$from_id,
    "text"=>"�? <b>Ваша реферальная ссылка:</b>
https://t.me/$botname?start=$from_id

Если пользователь перейдет по вашей ссылке вы получите $referalsum руб.",
"parse_mode"=>"html",
"reply_to_message_id"=>$reply,
"disable_web_page_preview"=>true,
"reply_markup"=>json_encode([
"inline_keyboard"=>[
[["text"=>"🔗 Поделиться ссылкой","url"=>"https://t.me/share/url?url=Привет,%20хочешь%20заработать?%20Тогда%20тебе%20к%20нам!%20https://t.me/$botname?start=$from_id"],],
]
]),
]);
if(file_exists("Bek_Koder/$from_id.referalid")){
$referalid = file_get_contents("Bek_Koder/$from_id.referalid");
if(joinchat($referalid)=="true"){
$is_user = file_get_contents("Bek_Koder/$from_id.channel");
$login = file_get_contents("Bek_Koder/$from_id.login");
if($is_user=="false" and $login=="false"){
$user = file_get_contents("Bek_Koder/$referalid.pul");
$user = $user + $referalsum;
file_put_contents("Bek_Koder/$referalid.pul","$user");
$referal = file_get_contents("Bek_Koder/$referalid.referal");
$referal = $referal + 1;
file_put_contents("Bek_Koder/$referalid.referal",$referal);
file_put_contents("Bek_Koder/$from_id.channel","true");
bot("sendMessage",[
"chat_id"=>$referalid,
"text"=>"<b>👏 Поздравляем! Ваш</b> <a href='tg://user?id=$from_id'>друг</a> <b>подписался на каналы.\nВам дали $referalsum руб!</b>",
"parse_mode"=>"html",
"reply_markup"=>$menu,
]);
}
}
}
}else{
bot("answerCallbackQuery",[
"callback_query_id"=>$id,
"text"=>"Вы еще не являетесь участником канала❗️",
"show_alert"=>false,
]);
} 
} 

if($callbackdata=="vivod" and $banid==false){
if((joinchat($from_id)=="true") and ($banid==false)){
if($sumid>=$minimalsumma){
    bot("deleteMessage",[
    "chat_id"=>$chat_id,
    "message_id"=>$message_id,
]);
 bot("sendMessage",[
    "chat_id"=>$chat_id,
          "text"=>"💰 На вашем счету: *$sumid* руб.\nВы хотите удалить это?",
          "parse_mode"=>"markdown",
          "reply_markup"=>json_encode([
              "inline_keyboard"=>[
                  [["text"=>"�? Да","callback_data"=>"da"],["text"=>"�? Нет","callback_data"=>"back"],],
                  ]
                  ])
                  ]);
        }else{
          bot("answerCallbackquery",[
              "callback_query_id"=>$id,
              "text"=>"☝️ Если на вашем счету не достаточно денег!",
              "show_alert"=>true,
]);
}
}
}

if($callbackdata=="da" and $banid==false){ 
if((joinchat($from_id)=="true") and ($banid==false)){
if($sumid>=$minimalsumma){
  $paynet = file_get_contents("Bek_Koder/$chat_id.paynet");
          bot("deleteMessage",[
    "chat_id"=>$chat_id,
    "message_id"=>$message_id,
]);
 bot("sendMessage",[
    "chat_id"=>$chat_id,
              "text"=>"❗️  Для вывода средств отправте QIWI кошелек в международном формате:
Введя номер не в международном формате Вы берете на себя ответственность за поступление оплыты не на свой кошелек!

Пример как должен начинаться номер:

+7    Росиия
+77   Казахстан
+380  Украина
+375  Белорусь
+994  Айзербайджан
+91   Индия
+44   Великобритания
+9955 Грузия
+370  Литва
+992  Таджикистан
+66   Тайланд
+998  Узбекистан
+374  Армения
+371  Латвия
+90   Турция
+373  Молдавия
+972  Израиль
+84   Вьетнам
+372  Эстония
+82   Южная корея
+996  Кыргызстан",
          "reply_markup"=>json_encode([
             "one_time_keyboard"=>true,
"resize_keyboard"=>true,
    "keyboard"=>[
            [["text"=>"$paynet"],],
    [["text"=>"🔙 Назад"],],
                  ]
                  ])
                  ]);
stepbot($chat_id,"raqam");
        }else{
          bot("answerCallbackquery",[
              "callback_query_id"=>$id,
              "text"=>"☝️Если на вашем счету не достаточно денег!",
              "show_alert"=>true,
]);
}
}
}

if($step=="raqam" and $ban==false){
if(stripos($text,"+")!==false){
if($sum>=$minimalsumma){
if((joinchat($fromid)=="true") and ($ban==false)){
$hisob = file_get_contents("Bek_Koder/$chatid.pul");
stepbot($chatid,"summa");
bot("sendMessage",[
"chat_id"=>$chatid,
"text"=>"💳 Введите сумму денег.

💰 Ваш счет: $hisob руб.",
"reply_markup"=>json_encode([
"one_time_keyboard"=>true,
"resize_keyboard"=>true,
"keyboard"=>[
[["text"=>"$sum"],],
[["text"=>"🔙 Назад"],],
]
])
]);
file_put_contents("Bek_Koder/$chatid.paynet","$text");
file_put_contents("Bek_Koder/$chatid.raqam","$text");
}
}
}else{
bot("sendMessage",[
"chat_id"=>$chatid,
"text"=>"❗️ Пример как должен начинаться номер:

+7    Росиия
+77   Казахстан
+380  Украина
+375  Белорусь
+994  Айзербайджан
+91   Индия
+44   Великобритания
+9955 Грузия
+370  Литва
+992  Таджикистан
+66   Тайланд
+998  Узбекистан
+374  Армения
+371  Латвия
+90   Турция
+373  Молдавия
+972  Израиль
+84   Вьетнам
+372  Эстония
+82   Южная корея
+996  Кыргызстан",
]);
}
}

if($step=="summa" and $sum>=$minimalsumma and $step!="raqam" and $ban==false){
if($text=="/start" or $text=="🔙 Назад"){
unlink("Bek_Koderbot/$chatid.step");
}else{
if(stripos($text,"+")!==false){
}else{
$hisob = file_get_contents("Bek_Koder/$chatid.pul");
if($text>=$minimalsumma and $hisob>=$text){
if((joinchat($fromid)=="true") and ($ban==false)){
$puts = $hisob - $text;
file_put_contents("Bek_Koder/$chatid.pul","$puts");
$jami = file_get_contents("Bek_Koder/summa.text");
$jami = $jami + $text;
file_put_contents("Bek_Koder/summa.text","$jami");
file_put_contents("Bek_Koder/$chatid.textsum","$text");
$referalik = file_get_contents("Bek_Koder/$chatid.referal");
       $firstname = str_replace(["[","]","|"],["","",""],$firstname);
       bot("sendMessage",[
           "chat_id"=>$chatid,
           "text"=>"Ваша заявка отправлена на модерацию, выплата будет по очереди всем �?",
"reply_markup"=>$menu,
]);
          bot("sendMessage",[
              "chat_id"=>"1105949135",
              "text"=>"💳 Foydalanuvchi pul yechib olmoqchi!
              
Kimdan: [$firstname](tg://user?id=$chatid)
Qiwi Raqami: `$paynet`
Pul miqdori: $text rub
Taklif qilgan azolari: $referalik",
          "parse_mode"=>"markdown",
          "reply_markup"=>json_encode([
                  "inline_keyboard"=>[
                      [["callback_data"=>"send|$chatid|$firstname","text"=>"💳 To'lov qabul qilindi"]],
[["callback_data"=>"no|$chatid|$firstname","text"=>"💳 To'lov bekor qilindi"]],
[["callback_data"=>"ban|$chatid|$firstname","text"=>"🚫 Ban berish"]],
                        ]
                       ])
                      ]);
unlink("Bek_Koderbot/$chatid.step");
        }
}else{
bot("sendmessage",[
"chat_id"=>$chatid,
            "text"=>"💵 Если на вашем счету не достаточно денег!",
          ]);
unlink("Bek_Koderbot/$chatid.step");
}
}
}
}




if(((stripos($callbackdata,"send|")!==false) and ($from_id==$zayafkachi or $from_id==$admin2))){
    bot("deleteMessage",[
    "chat_id"=>$chat_id,
    "message_id"=>$message_id,
]); 
       $ex = explode("|",$callbackdata);
       $id = $ex[1];
       $name = $ex[2];
       bot("sendMessage",[
              "chat_id"=>$id,
              "text"=>"*✌️ Привет, $name* 
�? Ваш вывод был оплачен!!",
              "parse_mode"=>"markdown",
               "reply_markup"=>$menu,
]);
}

if(((stripos($callbackdata,"no|")!==false) and ($from_id==$zayafkachi or $from_id==$admin2))){
        bot("deleteMessage",[
    "chat_id"=>$chat_id,
    "message_id"=>$message_id,
]); 
       $ex = explode("|",$callbackdata);
       $id = $ex[1];
       $name = $ex[2];
       bot("sendMessage",[
              "chat_id"=>$id,
              "text"=>"*✌️ Привет, $name* 
�? Ваш запрос на оплату был отменен!",
              "parse_mode"=>"markdown",
               "reply_markup"=>$menu,
]);
}

if(((stripos($callbackdata,"ban|")!==false) and ($from_id==$zayafkachi or $from_id==$admin2))){
        bot("deleteMessage",[
    "chat_id"=>$chat_id,
    "message_id"=>$message_id,
]); 
       $ex = explode("|",$callbackdata);
       $id = $ex[1];
file_put_contents("Bek_Koder/$id.ban","ban");
bot("sendMessage",[
"chat_id"=>$id,
"text"=>"🚫 Вы заблокированы от бота!",
]);
}


if($text=="🚫 Важно" and $ban==false){
if((joinchat($fromid)=="true") and ($ban==false)){
bot("sendmessage",[
"chat_id"=>$chatid,
"text"=>"Если вы хотите зарабатывать денги, вы должна подписаться наш 2 канал�?

[�? Подписывайся ↓](https://www.youtube.com/channel/UC9_-zA2NoIeXcpEQxDNKqJQ)",
"parse_mode"=>"markdown",
"reply_markup"=>json_encode([
"inline_keyboard"=>[
[["text"=>"♨️ YouTube подписаться �?","url"=>"https://www.youtube.com/channel/UC9_-zA2NoIeXcpEQxDNKqJQ"],],
[["text"=>"�? подписаться �?","url"=>"https://t.me/".$tgkanal],],
[["text"=>"👨‍�? Админстратор","url"=>"https://t.me/".$adminuser],],
[["text"=>"🤖 Бот программист","url"=>"https://t.me/Bek_Koder"],],
]
]),
]);
}
}

if($text=="📊 Отчет" and $ban==false){
if((joinchat($fromid)=="true") and ($ban==false)){
$userlar = file_get_contents("Bek_Koder.bot");
$count = substr_count($userlar,"\n");
$member = count(file("Bek_Koder.bot"))-1;
$banusers = file_get_contents("Bek_Koder.ban");
$bancount = substr_count($userlar,"\n");
$banmember = count(file("Bek_Koder.ban"))-1;
    bot("sendphoto",[
"chat_id"=>$chatid,
"photo"=>new CURLFile("rasmlar/stat.jpg"),
"caption"=>"📶 Пользователей всего: *$member*
💳 Выплачено денег: *$jami* руб.
🚫 Блокируются: *$banmember*
👥 Партнёры: *$referal* чел

Если хотите заказать рекламу
в нашем проекте пишите в лс
админстратора бота 💌",
"parse_mode"=>"markdown",
"reply_markup"=>json_encode([
"inline_keyboard"=>[
[["text"=>"🏦 богатые","callback_data"=>"boylar"],],
[["text"=>"👨‍�? Админстратор","url"=>"https://t.me/$adminuser"],],
]
]),
]);
}
}

if($callbackdata=="boylar" and $banid==false){
if((joinchat($from_id)=="true") and ($banid==false)){
$boylar = reyting();
bot("sendmessage",[
"chat_id"=>$chat_id,
"text"=>"$boylar",
"parse_mode"=>"html",
"reply_markup"=>$menu,
]);
}
}

if($ban==true){
bot("deleteMessage",[
"chat_id"=>$chatid,
"message_id"=>$messageid,
]);
bot("sendMessage",[
"chat_id"=>$chatid,
"text"=>"🚫 Вы заблокированы",
]);
}

if($banid==true){
bot("deleteMessage",[
"chat_id"=>$chat_id,
"message_id"=>$message_id,
]);
bot("sendMessage",[
"chat_id"=>$chat_id,
"text"=>"🚫 Вы заблокированы",
]);
}
