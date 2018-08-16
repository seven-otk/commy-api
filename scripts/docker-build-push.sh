#!/bin/bash

set -ev

app_name="7otk/commy-api"
local_image="api_$app_name"

docker build $app_name -f docker/api-dockerfile .

docker tag $app_name:$TRAVIS_BRANCH;
docker push $app_name:$TRAVIS_BRANCH;

docker tag $app_name:${TRAVIS_COMMIT:0:7};
docker push $app_name:${TRAVIS_COMMIT:0:7};

if [ ${TRAVIS_BRANCH} = "master" ]; then
    docker tag $app_name:latest;
    docker push $app_name:latest;
fi

exit 0;