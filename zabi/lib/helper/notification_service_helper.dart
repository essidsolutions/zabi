// ignore_for_file: unused_local_variable

import 'dart:io';

import 'package:flutter/material.dart';
import 'package:flutter_local_notifications/flutter_local_notifications.dart';
import 'package:flutter_timezone/flutter_timezone.dart';
import 'package:timezone/data/latest_all.dart' as tz;
import 'package:timezone/timezone.dart' as tz;

abstract class NotificationService {
  Future<void> initializeNotification();
  Future<void> scheduleNotification({
    required int id,
    required String title,
    required String body,
    required DateTime dateTime,
    String? payload,
  });
  Future<void> cancelNotification(int id);
  Future<List<PendingNotificationRequest>> getPendingNotifications();
  Future<List<ActiveNotification>> getActiveNotifications();
  Future<void> cancelAllNotifications();
  Future<void> sendNotification({required String title, required String body});
}

class NotificationServiceImpl implements NotificationService {
  final FlutterLocalNotificationsPlugin _flutterLocalNotificationsPlugin;

  NotificationServiceImpl()
      : _flutterLocalNotificationsPlugin = FlutterLocalNotificationsPlugin() {
    tz.initializeTimeZones();
  }

  Future<void> _checkNotificationPermission() async {
    if (Platform.isAndroid) {
      await _flutterLocalNotificationsPlugin
          .resolvePlatformSpecificImplementation<
              AndroidFlutterLocalNotificationsPlugin>()
          ?.requestNotificationsPermission();
    } else if (Platform.isIOS) {
      await _flutterLocalNotificationsPlugin
          .resolvePlatformSpecificImplementation<
              IOSFlutterLocalNotificationsPlugin>()
          ?.requestPermissions(
            alert: true,
            badge: true,
            sound: true,
          );
    }
  }

  @override
  Future<void> initializeNotification() async {
    await _checkNotificationPermission();
    const AndroidInitializationSettings initializationSettingsAndroid =
        AndroidInitializationSettings('dark_icon');

    final DarwinInitializationSettings initializationSettingsDarwin =
        DarwinInitializationSettings(
      onDidReceiveLocalNotification: _onDidReceiveLocalNotification,
      requestAlertPermission: true,
      requestBadgePermission: true,
      requestSoundPermission: true,
      defaultPresentAlert: true,
      defaultPresentBadge: true,
      defaultPresentSound: true,
    );

    const LinuxInitializationSettings initializationSettingsLinux =
        LinuxInitializationSettings(
      defaultActionName: 'Open notification',
    );

    final InitializationSettings initializationSettings =
        InitializationSettings(
      android: initializationSettingsAndroid,
      iOS: initializationSettingsDarwin,
      macOS: initializationSettingsDarwin,
      linux: initializationSettingsLinux,
    );

    await _flutterLocalNotificationsPlugin.initialize(
      initializationSettings,
      onDidReceiveNotificationResponse: _onDidReceiveNotificationResponse,
      onDidReceiveBackgroundNotificationResponse: _notificationTapBackground,
    );
  }

  @override
  Future<void> scheduleNotification({
    required int id,
    required String title,
    required String body,
    required DateTime dateTime,
    String? payload,
  }) async {
    final sound = id == 1 ? 'res_fajr_azan.mp3' : 'res_azan.mp3';
    final scheduledDate = await _nextInstance(dateTime);
    debugPrint('Scheduled time for $title: ${dateTime.toIso8601String()}');
    await _flutterLocalNotificationsPlugin.zonedSchedule(
      id,
      title,
      body,
      scheduledDate,
      _getNotificationDetails(
          sound: Platform.isAndroid ? sound.split(".").first : sound,
          channel: sound.split(".").first),
      androidScheduleMode: AndroidScheduleMode.exact,
      uiLocalNotificationDateInterpretation:
          UILocalNotificationDateInterpretation.absoluteTime,
      payload: payload,
    );
  }

  Future<tz.TZDateTime> _nextInstance(DateTime dateTime) async {
    final String timeZoneName = await FlutterTimezone.getLocalTimezone();
    final tz.TZDateTime scheduledDateTime = tz.TZDateTime.from(
      dateTime,
      tz.getLocation(timeZoneName),
    );

    final tzNow = tz.TZDateTime.now(tz.getLocation(timeZoneName));
    debugPrint('Current time: ${tzNow.toIso8601String()}');

    if (scheduledDateTime.isBefore(tzNow)) {
      return scheduledDateTime.add(const Duration(days: 1));
    }
    return scheduledDateTime;
  }

  @override
  Future<void> cancelAllNotifications() async {
    await _flutterLocalNotificationsPlugin.cancelAll();
  }

  @override
  Future<void> cancelNotification(int id) async {
    await _flutterLocalNotificationsPlugin.cancel(id);
  }

  @override
  Future<List<ActiveNotification>> getActiveNotifications() async {
    return _flutterLocalNotificationsPlugin.getActiveNotifications();
  }

  @override
  Future<List<PendingNotificationRequest>> getPendingNotifications() async {
    return _flutterLocalNotificationsPlugin.pendingNotificationRequests();
  }

  void _onDidReceiveLocalNotification(
    int id,
    String? title,
    String? body,
    String? payload,
  ) async {
    // Implement your own local notification handler here
  }

  void _onDidReceiveNotificationResponse(
    NotificationResponse notificationResponse,
  ) async {
    final String? payload = notificationResponse.payload;
    // Implement your own notification response handler here
  }

  @pragma('vm:entry-point')
  static void _notificationTapBackground(
    NotificationResponse notificationResponse,
  ) {
    // Implement your own background notification handler here
  }

  NotificationDetails _getNotificationDetails(
      {String? channel, String? sound}) {
    return NotificationDetails(
      android: AndroidNotificationDetails(
        channel ?? 'channelId',
        channel ?? 'channelName',
        importance: Importance.max,
        priority: Priority.max,
        sound: RawResourceAndroidNotificationSound(sound),
        playSound: true,
        enableVibration: false,
        category: AndroidNotificationCategory.alarm,
        fullScreenIntent: true,
        ticker: "ticker",
      ),
      iOS: DarwinNotificationDetails(
        presentAlert: true,
        presentBadge: true,
        presentSound: true,
        sound: sound,
      ),
    );
  }

  @override
  Future<void> sendNotification({
    required String title,
    required String body,
  }) async {
    await _flutterLocalNotificationsPlugin.show(
      0,
      title,
      body,
      _getNotificationDetails(sound: 'res_azan', channel: 'res_azan'),
    );
  }
}
