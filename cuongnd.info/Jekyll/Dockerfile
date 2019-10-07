FROM Ubuntu
RUN apt-get update
RUN apt-get install ruby-full build-essential zlib1g-dev
RUN echo '# Install Ruby Gems to ~/gems' >> ~/.bashrc
RUN echo 'export GEM_HOME="$HOME/gems"' >> ~/.bashrc
RUN echo 'export PATH="$HOME/gems/bin:$PATH"' >> ~/.bashrc
RUN source ~/.bashrc
RUN gem install jekyll bundler
CMD ['jekyll', 'new', 'cuongndinfo']
CMD ['cd', 'cuongndinfo']
CMD ['bundle', 'exec', 'jekyll', 'serve']
