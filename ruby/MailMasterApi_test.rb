# encoding: utf-8

require "rubygems"
require "rest-client"
require "json"


# Send Email
# params email hashObj :
# { :subject => 'test', :message => 'body', :to => 'xxx@xxx.com' }
def send_mail(mail, access_token)
  mail_api_host = "http://mail.api.com/"
  api_uri = mail_api_host + 'mails'
  uri = URI.parse(api_uri)

  query = mail.merge({'access_token' => access_token})

  res = Net::HTTP.start(uri.host, uri.port) do |http|
    req = Net::HTTP::Post.new(uri.path)

    http.request(req)
  end

  res_body = JSON.parse(res.body)
end

def send_mail_rest(mail, access_token)
  mail_api_host = "http://mail.api.com/"
  api_uri = mail_api_host + 'mails?access_token=' + access_token

  res = RestClient.post(api_uri, mail.to_json, :content_type => :json, :accept => :json)
  p res.to_s
end

def get_email
  {
    :from => "opennimei@test.com.cn",
    :from_user_id => 1,
    :to => "zhangjx1990@gmail.com",
    :subject => "test ni mei",
    :message => "<% hello world %>\n"
#    <<eos
#test nimei body, this is %<input text="input" width="100%" />
#eos
  }
end

def get_token
  '67f05f6ecc94bfe023cba27316a1fe8ebc1597e4' #254
  #'6c880d3dea631e426a2e37f7ae0627f45553ffe6' #156
end

#send_mail(get_email, get_token)
send_mail_rest(get_email, get_token)

=begin

# use rest-client create json post
def rest_client_post
  response = RestClient.post "https://sendcloud.sohu.com/webapi/mail.send.xml",
  :api_user => "username",
  :api_key => "password",
  :from => "from@sendcloud.com",
  :fromname => "from名称",
  :to => "to1@sendcloud.com;to2@sendcloud.com",
  :subject => "ruby 调用WebAPI测试主题",
  :html => '欢迎使用<a href="https://sendcloud.sohu.com">SendCloud</a>',
  :attachment1 => File.new("/path/to/doc/操作指南v2.6.pdf", 'rb'),
  :attachment2 => File.new("/path/to/doc/WEB API文档.pdf", 'rb')
  return response
end

# use net/http  create json post
def net_http_post

  host = 'pitchblende.socialtext.net'
  port = '22222'
  post_ws = "/data/workspaces"

  payload ={
    "name" => "api-workspace",
    "title" => "API Workspace",
    "account_id" => "1"
  }.to_json

  req = Net::HTTP::Post.new(post_ws, initheader = {'Content-Type' =>'application/json'})
  req.body = payload
  response = Net::HTTP.new(host, port).start {|http| http.request(req) }
  puts "Response #{response.code} #{response.message}: #{response.body}"
end

=end

