module Body
  require 'net/http'
  require 'uri'
  require 'json'

  def self.set_post
    params = { :m => 'email', :a => 'send', :datatype => 'json' }
    email = { :subject => 'test', :message => 'body',
              :to => 'zhangjx1990@gmail.com' }.to_json
    uri = URI.parse('http://email.mexi.im/')
    req = Net::HTTP::Post.new(uri.path)
    req.set_form_data(params.merge({ 'email' => email }))
    res = Net::HTTP.new(uri.host, uri.port).start do |http|
      http.request(req)
    end

    p JSON.parse(res.body)
  end
end

Body.set_post
