FROM ubuntu:latest

WORKDIR /opt/runner

SHELL ["/bin/bash", "-c"]

RUN apt-get update && \
apt-get install -y \
curl \
bash

RUN chown 1000:1000 /opt/runner


USER 1000:1000
RUN mkdir actions-runner && \
cd actions-runner

RUN curl -o actions-runner-linux-x64-2.303.0.tar.gz -L https://github.com/actions/runner/releases/download/v2.303.0/actions-runner-linux-x64-2.303.0.tar.gz

RUN tar xzf ./actions-runner-linux-x64-2.303.0.tar.gz
USER root
RUN ./bin/installdependencies.sh

USER 1000:1000
# RUN ./config.sh --url ${GITHUB_REPOSITORY_URL} --token ${GITHUB_TOKEN}

# CMD ./run.sh
