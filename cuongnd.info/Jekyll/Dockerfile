FROM ubuntu
RUN apt-get update
RUN apt-get install -y ruby-full build-essential zlib1g-dev && apt-get clean && rm -rf /var/lib/apt/lists/*
RUN gem install jekyll bundler

CMD ['jekyll', 'new', 'blogcuongndinfo']
CMD ['cd', 'blogcuongndinfo']
CMD ['bundle', 'exec', 'jekyll', 'serve']
