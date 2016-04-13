# encoding: utf-8
#
require 'rubygems'
require 'logger'
require 'pony'
require 'data/email.rb'

def map_mails(to, settings)
  {
    to: to,
    subject: 'OpenMaster 激活账户(仅供测试)',
    from: 'OpenMaster 开放平台 <open@test.com.cn>',
    html_body: get_body,
    via: 'smtp',
    via_options: settings,
  }
end


def get_body
body = <<eos
<div>您好：</div>
<div><br></div>
<div>
    <blockquote style="margin: 0 0 0 40px; border: none; padding: 0px;">
        <div>translation missing: cn.email_active_desc</div>
        <div><br></div>
        <div>
            <a href="http://open.test.com.cn/user/active/234/77b63dd2ssss">激活账户</a>
        </div>
        <div><br></div>
        <div>或者复制下面的url到浏览器中打开：</div>
        <div><br></div>
        <div>
            <a href="http://open.test.com.cn/user/active/234/77b63dd2ssss">http://open.test.com.cn/user/active/234/77b63dd2ssss</a>
        </div>
    </blockquote>
</div>
eos
end

def send_mail(to)
  settings = get_settings_3
  mails = map_mails(to, settings)
  p mails

  Pony.mail(mails)
end

def multi_mail()
  logger = Logger.new("./log/email.log", 'weekly')
  logger.info('[ Start Send Mail ]')
  mails = get_to

  begin
    send_mail(mails)
    logger.info("[ Success Send Mail ]: [id] #{mails} ")
  rescue
    logger.info("[ Failed Send Mail ]: [id] #{mails} ")
    logger.error("[ Error Info ]: #{$!} At: #{$@}")
  end

  logger.info('[ End Send Mail ]')
  logger.close
end

def single_mail()
  logger = Logger.new("./log/email.log", 'weekly')
  logger.info('[ Start Send Mail ]')
  mails = get_to

  mails.each do |mail|
    begin
      send_mail(mail)
      logger.info("[ Success Send Mail ]: [id] #{mail} ")
    rescue
      logger.info("[ Failed Send Mail ]: [id] #{mail} ")
      logger.error("[ Error Info ]: #{$!} At: #{$@}")
    end
  end

  logger.info('[ End Send Mail ]')
  logger.close
end

single_mail()
#multi_mail()
