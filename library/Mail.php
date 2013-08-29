<?php
/**
 * chenzhidong
 * 2013-6-9
 */
class Mail{
	public static function sendTextMail($subject,$tos,$from,$from_name,$content,$attachs=null){
		$mailer=Mail::getTransport();
		$mailer->Subject=$subject;
		$mailer->SetFrom($from,$from_name);
		
		if(isset($tos['address'])){
			$tos=array($tos);
		}
		foreach ($tos as $to){
			if(isset($to['address'])){
				$mailer->AddAddress($to['address'],isset($to['name'])?$to['name']:'');
			}
		}
		
		$mailer->IsHTML(false);
		$mailer->Body=$content;
		if(!empty($attachs) && is_array($attachs)){
			foreach ($attachs as $attach){
				if(file_exists($attach)){
					$mailer->AddAttachment($attach);
				}
			}
		}
		if(!$mailer->Send()){
			throw new Exception($mailer->ErrorInfo);
		}
		return true;
	}

	public static function sendHtmlMailFromTemplate($subject,$tos,$from,$from_name,$template,$argv,$attachs=null){
		$mailer=Mail::getTransport();
		$mailer->Subject=$subject;
		$mailer->SetFrom($from,$from_name);

		if(isset($tos['address'])){
			$tos=array($tos);
		}
		foreach ($tos as $to){
			if(isset($to['address'])){
				$mailer->AddAddress($to['address'],isset($to['name'])?$to['name']:'');
			}
		}
		$mailer->IsHTML(true);

		$v=new Vemplator();
		$v->assign($argv);
		$content=$v->output($template);
		$mailer->MsgHTML($content);

		if(!empty($attachs) && is_array($attachs)){
			foreach ($attachs as $attach){
				if(file_exists($attach)){
					$mailer->AddAttachment($attach);
				}
			}
		}
		if(!$mailer->Send()){
			throw new Exception($mailer->ErrorInfo);
		}
		return true;
	}

	public static function sendHtmlMail($subject,$tos,$from,$from_name,$content,$attachs=null){
		$mailer=Mail::getTransport();
		$mailer->Subject=$subject;
		$mailer->SetFrom($from,$from_name);

		if(isset($tos['address'])){
			$tos=array($tos);
		}
		foreach ($tos as $to){
			if(isset($to['address'])){
				$mailer->AddAddress($to['address'],isset($to['name'])?$to['name']:'');
			}
		}

		$mailer->IsHTML(true);
		$mailer->MsgHTML($content);
		if(!empty($attachs) && is_array($attachs)){
			foreach ($attachs as $attach){
				if(file_exists($attach)){
					$mailer->AddAttachment($attach);
				}
			}
		}
		if(!$mailer->Send()){
			throw new Exception($mailer->ErrorInfo);
		}
		return true;
	}

	private static function getTransport(){
		if(defined('SMTP_SERVER') && defined('SMTP_SSL') && defined('SMTP_USERNAME') && defined('SMTP_PASSWORD')){
			$mailer=new PHPMailer();
			$mailer->IsSMTP();
			$mailer->Host=SMTP_SERVER;
			$mailer->SMTPAuth=SMTP_SSL;
			if(SMTP_SSL){
				$mailer->SMTPSecure='ssl';
				$mailer->Port=465;
			}
			else{
				$mailer->Port=25;
			}
			//$mailer->SMTPDebug=true;
			$mailer->CharSet='UTF-8';
			$mailer->Username=SMTP_USERNAME;
			$mailer->Password=SMTP_PASSWORD;
			if(defined('SMTP_HELO')){
				$mailer->Helo=SMTP_HELO;
			}
			return $mailer;
		}
		else{
			throw new Exception('Can\'t find SMTP configuration');
		}
	}
}