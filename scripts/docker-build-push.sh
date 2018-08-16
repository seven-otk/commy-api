#!/bin/bash

set -ev

echo "$DOCKER_PASSWORD" | docker login -u "$DOCKER_USERNAME" --password-stdin

docker build -t $IMAGE_NAME:${TRAVIS_COMMIT:0:7} -f docker/api-dockerfile .

docker push $IMAGE_NAME:${TRAVIS_COMMIT:0:7};

if [ ${TRAVIS_BRANCH} = "master" ]; then
    docker tag $IMAGE_NAME:${TRAVIS_COMMIT:0:7} $IMAGE_NAME:latest;
    docker push $IMAGE_NAME:latest;
fi

exit 0;