require 'csv'

content = File.read('./data/test.csv')

CSV.parse(content) do |row|
  p row
end
