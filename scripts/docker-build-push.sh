#!/bin/bash

set -ev

docker build -t $IMAGE_NAME -f docker/api-dockerfile .

docker tag $IMAGE_NAME:$TRAVIS_BRANCH;
docker push $IMAGE_NAME:$TRAVIS_BRANCH;

docker tag $IMAGE_NAME:${TRAVIS_COMMIT:0:7};
docker push $IMAGE_NAME:${TRAVIS_COMMIT:0:7};

if [ ${TRAVIS_BRANCH} = "master" ]; then
    docker tag $IMAGE_NAME:latest;
    docker push $IMAGE_NAME:latest;
fi

exit 0;