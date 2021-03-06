<?php
//Protocol Corporation Ltda.
//https://github.com/ProtocolLive
//2022.05.28.00

class MtpMethod_BotImportAuth{
  public readonly string $Flags;
  public readonly int $ApiId;
  public readonly string $ApiHash;
  public readonly string $Token;

  public function __toString(){
    $temp = 'Flags: ' . $this->Flags . PHP_EOL;
    $temp .= 'ApiId: ' . $this->ApiId . PHP_EOL;
    $temp .= 'ApiHash: ' . $this->ApiHash . PHP_EOL;
    $temp .= 'Token: ' . $this->Token;
    return $temp;
  }

  public function Parse(string $Data):void{
    $this->Flags = substr($Data, 0, 8);
    $Data = substr($Data, 8);

    $temp = substr($Data, 0, 8);
    $Data = substr($Data, 8);
    $temp = MtprotoBasics::InvertEndian($temp);
    $this->ApiId = hexdec($temp);

    $temp = substr($Data, 0, 72);
    $this->ApiHash = MtprotoBasics::StringDecode($temp);
    $Data = substr($Data, 72);

    $this->Token = MtprotoBasics::StringDecode($Data);
  }
}