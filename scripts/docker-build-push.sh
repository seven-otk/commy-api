#!/bin/bash

set -ev

echo "$DOCKER_PASSWORD" | docker login -u "$DOCKER_USERNAME" --password-stdin

docker build -t 7otk/commy-api:${TRAVIS_COMMIT:0:7} -f docker/api-dockerfile .

if [ ${TRAVIS_BRANCH} = "master" ]; then
    docker tag 7otk/commy-api:${TRAVIS_COMMIT:0:7} 7otk/commy-api:latest;
    docker push 7otk/commy-api:latest;
fi

if [ ${TRAVIS_BRANCH} = "develop" ]; then
    docker tag 7otk/commy-api:${TRAVIS_COMMIT:0:7} 7otk/commy-api:develop;
    docker push 7otk/commy-api:develop;
fi

if [ ${TRAVIS_BRANCH} = "staging" ]; then
    docker tag 7otk/commy-api:${TRAVIS_COMMIT:0:7} 7otk/commy-api:staging;
    docker push 7otk/commy-api:staging;
fi

exit 0;