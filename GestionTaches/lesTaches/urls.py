import imp
from nturl2path import url2pathname
from django.urls import path

from . import views
urlpatterns=[
    path('home/<param>', views.home, name='home'),

    path('listing', views.task_listing2, name='listing'),
]