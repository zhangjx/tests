
class Object
  def blank?
    p self
    respond_to?(:empty?) ? empty? : !self
  end
end

a = 'xx'

p a.blank?

